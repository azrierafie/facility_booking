<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Facilities Controller
 *
 * @property \App\Model\Table\FacilitiesTable $Facilities
 */
class FacilitiesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'view', 'browse', 'details', 'add', 'edit', 'delete']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Facilities->find()
            ->contain(['Departments']);
        $facilities = $this->paginate($query);

        $this->set(compact('facilities'));
    }

    /**
     * Browse method - Card-based view for browsing facilities
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function browse()
    {
        $query = $this->Facilities->find()
            ->contain(['Departments']);

        // Search filter for facility name
        $searchFacility = $this->request->getQuery('facility');

        if (!empty($searchFacility)) {
            $query->where(['Facilities.name LIKE' => '%' . $searchFacility . '%']);
        }

        $facilities = $this->paginate($query);

        // Load upcoming bookings for each facility
        $bookingsTable = $this->fetchTable('Bookings');
        
        foreach ($facilities as $facility) {
            $bookingsQuery = $bookingsTable->find()
                ->contain(['Users'])
                ->where([
                    'facility_id' => $facility->id,
                    'status IN' => ['approved', 'pending'],
                    'booking_date >=' => date('Y-m-d')
                ])
                ->order(['booking_date' => 'ASC', 'start_time' => 'ASC'])
                ->limit(10);

            $facility->bookings = $bookingsQuery->all();
        }

        $this->set(compact('facilities', 'searchFacility'));
    }

    /**
     * Details method - User-friendly view details
     *
     * @param string|null $id Facility id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function details($id = null)
    {
        $facility = $this->Facilities->get($id, contain: ['Departments']);
        
        // Get upcoming bookings for availability check
        $bookingsTable = $this->fetchTable('Bookings');
        $upcomingBookings = $bookingsTable->find()
            ->where([
                'facility_id' => $id,
                'status IN' => ['approved', 'pending'],
                'booking_date >=' => date('Y-m-d')
            ])
            ->order(['booking_date' => 'ASC', 'start_time' => 'ASC'])
            ->limit(20)
            ->all();
            
        $this->set(compact('facility', 'upcomingBookings'));
    }

    /**
     * View method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facility = $this->Facilities->get($id, contain: ['Departments', 'Bookings']);
        $this->set(compact('facility'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $facility = $this->Facilities->newEmptyEntity();
        if ($this->request->is('post')) {
            $facility = $this->Facilities->patchEntity($facility, $this->request->getData());
            if ($this->Facilities->save($facility)) {
                $this->Flash->success(__('The facility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facility could not be saved. Please, try again.'));
        }
        $departments = $this->Facilities->Departments->find('list', limit: 200)->all();
        $this->set(compact('facility', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facility = $this->Facilities->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facility = $this->Facilities->patchEntity($facility, $this->request->getData());
            if ($this->Facilities->save($facility)) {
                $this->Flash->success(__('The facility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facility could not be saved. Please, try again.'));
        }
        $departments = $this->Facilities->Departments->find('list', limit: 200)->all();
        $this->set(compact('facility', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facility = $this->Facilities->get($id);
        if ($this->Facilities->delete($facility)) {
            $this->Flash->success(__('The facility has been deleted.'));
        } else {
            $this->Flash->error(__('The facility could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
