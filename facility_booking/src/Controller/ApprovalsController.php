<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Approvals Controller
 *
 * @property \App\Model\Table\ApprovalsTable $Approvals
 */
class ApprovalsController extends AppController
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
        $query = $this->Approvals->find()
            ->contain(['Bookings.Users', 'Bookings.Facilities']);
        $approvals = $this->paginate($query);

        $this->set(compact('approvals'));
    }

    /**
     * View method
     *
     * @param string|null $id Approval id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $approval = $this->Approvals->get($id, contain: ['Bookings']);
        $this->set(compact('approval'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $approval = $this->Approvals->newEmptyEntity();
        if ($this->request->is('post')) {
            $approval = $this->Approvals->patchEntity($approval, $this->request->getData());
            if ($this->Approvals->save($approval)) {
                // Fetch the booking to sync status
                $booking = $this->Approvals->Bookings->get($approval->booking_id);
                $booking->status = $approval->status;
                $this->Approvals->Bookings->save($booking);
                
                $this->Flash->success(__('The approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The approval could not be saved. Please, try again.'));
        }
        $bookings = $this->Approvals->Bookings->find('list', limit: 200)->all();
        $this->set(compact('approval', 'bookings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Approval id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $approval = $this->Approvals->get($id, contain: ['Bookings.Users', 'Bookings.Facilities']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $approval = $this->Approvals->patchEntity($approval, $this->request->getData());
            if ($this->Approvals->save($approval)) {
                // Sync status to Booking
                if ($approval->booking) {
                    $approval->booking->status = $approval->status;
                    $this->Approvals->Bookings->save($approval->booking);
                }
                
                $this->Flash->success(__('The approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The approval could not be saved. Please, try again.'));
        }
        $bookings = $this->Approvals->Bookings->find('list', limit: 200)->all();
        $this->set(compact('approval', 'bookings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Approval id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $approval = $this->Approvals->get($id);
        if ($this->Approvals->delete($approval)) {
            $this->Flash->success(__('The approval has been deleted.'));
        } else {
            $this->Flash->error(__('The approval could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
