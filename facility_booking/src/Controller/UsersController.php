<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        $this->Authentication->addUnauthenticatedActions(['login', 'register', 'index', 'view', 'add', 'edit', 'delete', 'logout']);
    }
    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful login
     */
    public function login()
    {
        // Disable layout for standalone login page
        $this->viewBuilder()->disableAutoLayout();
        
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');
            
            // Find user by email
            $user = $this->Users->find()
                ->where(['email' => $email])
                ->first();
            
            if ($user) {
                // User found - check password (plain text comparison)
                if ($user->password === $password) {
                    // Set the authenticated identity
                    $this->Authentication->setIdentity($user);
                    
                    // Redirect based on actual user role from database
                    if (strtolower($user->role) === 'admin') {
                        $this->Flash->success(__('Welcome back, Admin!'));
                        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
                    } else {
                        $this->Flash->success(__('Welcome back!'));
                        return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
                    }
                } else {
                    $this->Flash->error(__('Invalid password. Please try again.'));
                }
            } else {
                $this->Flash->error(__('No account found with that email address.'));
            }
        }
    }

    /**
     * Logout method
     * 
     * @return \Cake\Http\Response|null|void Redirects to login
     */
    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Register method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful registration
     */
    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            // Set default role for self-registration
            $user->role = 'user';
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registration successful! Please login.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Registration failed. Please, try again.'));
        }
        $departments = $this->Users->Departments->find('list', limit: 200)->all();
        $this->set(compact('user', 'departments'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find()
            ->contain(['Departments']);
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: ['Departments', 'Bookings']);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $departments = $this->Users->Departments->find('list', limit: 200)->all();
        $this->set(compact('user', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $departments = $this->Users->Departments->find('list', limit: 200)->all();
        $this->set(compact('user', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
