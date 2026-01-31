<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dashboard Controller
 * 
 * Provides admin dashboard with statistics and quick access to all CRUD operations
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\FacilitiesTable $Facilities
 * @property \App\Model\Table\BookingsTable $Bookings
 * @property \App\Model\Table\DepartmentsTable $Departments
 * @property \App\Model\Table\ApprovalsTable $Approvals
 */
class DashboardController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Allow public access since authentication is disabled
        $this->Authentication->addUnauthenticatedActions(['index', 'approvals', 'approve', 'reject']);
        
        // Admin-only access for approval actions (when auth is enabled)
        $identity = $this->request->getAttribute('identity');
        if ($this->request->getParam('action') === 'approvals' || 
            $this->request->getParam('action') === 'approve' || 
            $this->request->getParam('action') === 'reject') {
            if ($identity && strtolower($identity->role ?? '') !== 'admin') {
                $this->Flash->error('Access denied. Admin only.');
                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            }
        }
    }
    
    /**
     * Index method
     * 
     * Displays admin dashboard with statistics from all tables
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Load models
        $usersTable = $this->fetchTable('Users');
        $facilitiesTable = $this->fetchTable('Facilities');
        $bookingsTable = $this->fetchTable('Bookings');
        $departmentsTable = $this->fetchTable('Departments');
        $approvalsTable = $this->fetchTable('Approvals');
        
        // Get statistics
        $stats = [
            'totalUsers' => $usersTable->find()->count(),
            'totalFacilities' => $facilitiesTable->find()->count(),
            'totalBookings' => $bookingsTable->find()->count(),
            'totalDepartments' => $departmentsTable->find()->count(),
            'pendingApprovals' => $bookingsTable->find()->where(['status' => 'pending'])->count(),
            'approvedBookings' => $bookingsTable->find()->where(['status' => 'approved'])->count(),
            'rejectedBookings' => $bookingsTable->find()->where(['status' => 'rejected'])->count(),
            'todayBookings' => $bookingsTable->find()->where(['booking_date' => date('Y-m-d')])->count(),
        ];
        
        // Get bookings per facility for the pie chart
        $bookingsPerFacility = $bookingsTable->find()
            ->select([
                'facility_id',
                'count' => $bookingsTable->find()->func()->count('Bookings.id'),
                'facility_name' => 'Facilities.name'
            ])
            ->contain(['Facilities'])
            ->group(['Bookings.facility_id', 'Facilities.name'])
            ->all();
        
        // Get recent bookings
        $recentBookings = $bookingsTable->find()
            ->contain(['Users', 'Facilities'])
            ->order(['Bookings.created_at' => 'DESC'])
            ->limit(5)
            ->all();
        
        // Get recent approvals
        $recentApprovals = $approvalsTable->find()
            ->contain(['Bookings'])
            ->order(['Approvals.approved_at' => 'DESC'])
            ->limit(5)
            ->all();
        
        $this->set(compact('stats', 'recentBookings', 'recentApprovals', 'bookingsPerFacility'));
    }
    
    /**
     * Approvals method
     * 
     * Show booking approval management interface for admins
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function approvals()
    {
        $bookingsTable = $this->fetchTable('Bookings');
        
        // Get pending bookings with user and facility details
        $pendingBookings = $bookingsTable->find()
            ->contain(['Users.Departments', 'Facilities'])
            ->where(['Bookings.status' => 'pending'])
            ->order(['Bookings.booking_date' => 'ASC', 'Bookings.start_time' => 'ASC'])
            ->all();
        
        $this->set(compact('pendingBookings'));
    }
    
    /**
     * Approve booking
     *
     * @param int $bookingId Booking ID
     * @return \Cake\Http\Response Redirects back to approvals
     */
    public function approve($bookingId = null)
    {
        $this->request->allowMethod(['post']);
        $bookingsTable = $this->fetchTable('Bookings');
        $approvalsTable = $this->fetchTable('Approvals');
        
        $booking = $bookingsTable->get($bookingId);
        $identity = $this->request->getAttribute('identity');
        
        // Update booking status
        $booking->status = 'approved';
        if ($bookingsTable->save($booking)) {
            // Create approval record
            $approval = $approvalsTable->newEmptyEntity();
            $approval->booking_id = $bookingId;
            $approval->status = 'approved';
            $approval->notes = $this->request->getData('notes') ?? 'Approved';
            $approval->approved_by = $identity ? $identity->getIdentifier() : null;
            $approval->approved_at = new \DateTime();
            
            $approvalsTable->save($approval);
            $this->Flash->success('Booking approved successfully.');
        } else {
            $this->Flash->error('Failed to approve booking.');
        }
        
        return $this->redirect(['action' => 'approvals']);
    }
    
    /**
     * Reject booking
     *
     * @param int $bookingId Booking ID
     * @return \Cake\Http\Response Redirects back to approvals
     */
    public function reject($bookingId = null)
    {
        $this->request->allowMethod(['post']);
        $bookingsTable = $this->fetchTable('Bookings');
        $approvalsTable = $this->fetchTable('Approvals');
        
        $booking = $bookingsTable->get($bookingId);
        $identity = $this->request->getAttribute('identity');
        
        // Update booking status
        $booking->status = 'rejected';
        if ($bookingsTable->save($booking)) {
            // Create approval record
            $approval = $approvalsTable->newEmptyEntity();
            $approval->booking_id = $bookingId;
            $approval->status = 'rejected';
            $approval->notes = $this->request->getData('notes') ?? 'Rejected';
            $approval->approved_by = $identity ? $identity->getIdentifier() : null;
            $approval->approved_at = new \DateTime();
            
            $approvalsTable->save($approval);
            $this->Flash->success('Booking rejected.');
        } else {
            $this->Flash->error('Failed to reject booking.');
        }
        
        return $this->redirect(['action' => 'approvals']);
    }
}
