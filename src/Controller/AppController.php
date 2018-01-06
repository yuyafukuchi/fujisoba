<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Muffin\Footprint\Auth\FootprintAwareTrait;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    use FootprintAwareTrait;

    // Load Bootstrap plugin
    public $helpers = [
        'Less.Less',
        'BootstrapUI.Form',
        'BootstrapUI.Html',
        'BootstrapUI.Flash',
        'BootstrapUI.Paginator'
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * beforeFilter callback.
     *
     * @param \Cake\Event\Event $event Event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeFilter(Event $event)
    {
        $this->loadModel('Users');
        $type = $this->Auth->user('type');
        $name = '';

        if ($type === 'H') {
            $name = '本社管理者';
            $searchQuery['company_id'] = $this->Auth->user('company_id');
            $companies = $this->Users->Companies->find('list', ['limit' => 200]);
            $stores = $this->Users->Stores->find('list', ['limit' => 200]);
        } elseif ($type === 'M') {
            $searchQuery['company_id'] = $this->Auth->user('company_id');
            $searchQuery['store_id'] = $this->Auth->user('store_id');
            $name = $this->Users->Stores->get($this->Auth->user('store_id'))['name'].'/店舗管理者';
            $companies = $this->Users->Companies->find('list', ['limit' => 200])->where(['id' => $this->Auth->user('company_id')]);
            $stores = $this->Users->Stores->find('list', ['limit' => 200])->where(['id' => $this->Auth->user('store_id')]);
        }
        $data = array('type' => $type, 'name' => $name);
        $this->set(compact('companies', 'stores', 'data'));
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        // Load Bootstrap layout
        // $this->viewBuilder()->theme('Bootstrap');

        if ($this->request->prefix === 'attendance') {
            $this->set('mode', 'atendance');
        }

        if ($this->request->prefix === 'sales') {
            $this->viewBuilder()->setLayout('sales');
        }

        if (isset($this->Auth)) {
            $this->set('currentUser', $this->Auth->user()); // debug($this->Auth); die;
        }

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
