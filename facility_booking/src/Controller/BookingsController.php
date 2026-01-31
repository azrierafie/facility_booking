<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 */
class BookingsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'view', 'add', 'edit', 'delete']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Bookings->find()
            ->contain(['Users', 'Facilities', 'Approvals']);
            
        $identity = $this->request->getAttribute('identity');
        if ($identity && strtolower($identity->role ?? '') !== 'admin') {
            $query->where(['Bookings.user_id' => $identity->getIdentifier()]);
        }

        $bookings = $this->paginate($query);

        $this->set(compact('bookings'));
    }

    /**
     * View method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $booking = $this->Bookings->get($id, contain: ['Users', 'Facilities', 'Approvals']);
        $this->set(compact('booking'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $booking = $this->Bookings->newEmptyEntity();
        
        // Pre-fill User ID from logged in user
        $identity = $this->request->getAttribute('identity');
        if ($identity) {
            $booking->user_id = $identity->getIdentifier();
        }

        // Pre-fill Facility ID from query param
        $facilityId = $this->request->getQuery('facility_id');
        if ($facilityId) {
            $booking->facility_id = (int)$facilityId;
        }

        if ($this->request->is('post')) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            
            // Force user_id to current user if not admin (security)
            if ($identity && strtolower($identity->role ?? '') !== 'admin') {
                $booking->user_id = $identity->getIdentifier();
            }
            
            // Set default status to pending
            $booking->status = 'pending';

            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('Booking request submitted successfully. Waiting for approval.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        
        // Only list users if admin, otherwise just current user or hidden associated
        $users = $this->Bookings->Users->find('list', limit: 200)->all();
        $facilities = $this->Bookings->Facilities->find('list', limit: 200)->all();
        $this->set(compact('booking', 'users', 'facilities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $booking = $this->Bookings->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $users = $this->Bookings->Users->find('list', limit: 200)->all();
        $facilities = $this->Bookings->Facilities->find('list', limit: 200)->all();
        $this->set(compact('booking', 'users', 'facilities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    /**
     * Receipt method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function receipt($id = null)
    {
        $booking = $this->Bookings->get($id, contain: ['Users', 'Facilities', 'Approvals']);
        
        $identity = $this->request->getAttribute('identity');
        if ($identity && strtolower($identity->role ?? '') !== 'admin') {
            if ($booking->user_id !== $identity->getIdentifier()) {
                $this->Flash->error(__('You are not authorized to view this receipt.'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->viewBuilder()->setLayout('ajax');
        $this->set(compact('booking'));
    }
}
