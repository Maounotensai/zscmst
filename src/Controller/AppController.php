<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\View\ViewBuilder;
use Cake\View\Helper\UrlHelper;

//for cakephp query
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');

        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [

          'authenticate' => [

            'Form' => [

              'fields' => [

                'username' => 'username', // Replace with your username field

                'password' => 'password' // Replace with your password field

              ]

            ]

          ],

          'loginAction' => [

            'controller' => 'Pages',

            'action' => 'login'

          ],

          'logoutRedirect' => [

            'controller' => 'Pages',

            'action' => 'login'

          ]

        ]);

        $this->Users = TableRegistry::getTableLocator()->get('Users');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event) {

      parent::beforeFilter($event);

      //Uncomment to show error, if not redirect to error landing page

      // if($this->name == 'CakeError'){

      //   $this->layout = 'error';

      // }

      // $this->viewBuilder()->setHelpers(['Access']);

      $this->viewBuilder()->setLayout('login');

      $viewBuilder = new ViewBuilder();

      $view = $viewBuilder->build();

      $urlHelper = new UrlHelper($view);

      $base = $urlHelper->build('/', ['fullBase' => true]);

      $currentUser = array();

      $grades = array();

      $user = $this->Auth->user();

      if(!empty($user)){

        $this->viewBuilder()->setLayout('default');

        $currentUser = $this->Users->find()->contain([

          'UserPermissions' => [

            'Permissions',

            'conditions' => ['UserPermissions.visible' => 1]

          ],

          'Roles' => [

            'conditions' => ['Roles.visible' => 1]

          ],

          'Students' =>[

            'conditions' => ['Students.visible' => 1]]

          

        ])

        ->where([

          'Users.visible' => 1,

          'Users.id' => $user['id']

        ])

        ->firstOrFail();

        if(!empty($currentUser)){

          // var_dump($currentUser->toArray()['user_permissions']);

          if(!empty($currentUser->toArray()['user_permissions'])){

            foreach ($currentUser->toArray()['user_permissions'] as $k => $permission) {

              $currentUser->toArray()['user_permissions'][$k] = $permission['Permission']['module'] .  '/' . $permission['Permission']['action'];

            }

          }



        }

      }

      $this->currentUser = $currentUser;

      $this->base = $base;

      $this->set(compact('base','currentUser','grades'));

    }

}
