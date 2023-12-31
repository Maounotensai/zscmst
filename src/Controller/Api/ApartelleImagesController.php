<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;


class ApartelleImagesController extends AppController {
   
  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('Paginator');

    $this->loadComponent('RequestHandler');

    $this->Apartelles = TableRegistry::getTableLocator()->get('Apartelles');

    $this->ApartelleImages = TableRegistry::getTableLocator()->get('ApartelleImages');

     $this->UserLogs = TableRegistry::getTableLocator()->get('UserLogs');

     $this->autoRender = false;

  }



  public function add(){

    $this->autoRender = false;

    if ($this->request->is(['post', 'ajax']) && $this->request->is('json')) {

        $requestData = $this->request->getData('data');

        $requestData = json_decode($requestData, true);

        $id = @$requestData[0]['apartelle_id'];

      $uploadedFiles = $this->request->getUploadedFiles();

      if (!empty($uploadedFiles)) {

        foreach ($uploadedFiles as $fieldName => $images) {

            foreach ($images as $ctr => $image) {

              $path = "uploads/apartelle/$id";

              if (!file_exists($path)) {

                mkdir($path, 0777, true);

              }

              $filename = $image->getClientFilename(); // Corrected line

              $image->moveTo($path . '/' . $filename);
            }

        }
      }


        if (!empty($requestData)) {

            foreach ($requestData as $key => $value) {

                $requestData[$key]['images'] = $value['images'];

            }

        }

        $entities = $this->ApartelleImages->newEntities($requestData);

        if ($this->ApartelleImages->saveMany($entities)) {

            $response = [

                'ok' => true,

                'msg' => 'Image(s) successfully saved.',

                'data' => $requestData,

            ];

            $userLogEntity = $this->UserLogs->newEntity([

            'action' => 'Add',

            'description' => 'Student Applciation Management',

            'created' => date('Y-m-d H:i:s'),

            'modified' => date('Y-m-d H:i:s')

          ]);

          $this->UserLogs->save($userLogEntity);

        } else {

            $response = [

                'ok' => false,

                'msg' => 'Image(s) cannot be saved at this time.',

            ];
        }
    
    $this->set([

        'response' => $response,

        '_serialize' => 'response'

      ]);


    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

    }
  }

   

}
