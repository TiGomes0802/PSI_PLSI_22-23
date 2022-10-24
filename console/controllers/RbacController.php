<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
    
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
    //---------------------------------- Role -------------------------------------//

        $admin      = $auth->createRole('admin');
        $gestor     = $auth->createRole('gestor');
        $rp         = $auth->createRole('rp');
        $cliente    = $auth->createRole('cliente');
        $seguranca  = $auth->createRole('seguranca');
       
    //------------------------------- Permission ----------------------------------//

        //Add Evento permission
        //Create
        $createEvento = $auth->createPermission('createEvento');
        $createEvento->description = 'Create a evento';
        $auth->add($createEvento);
        //Update
        $updateEvento = $auth->createPermission('updateEvento');
        $updateEvento->description = 'Update a evento';
        $auth->add($updateEvento);
        //Delete
        $deleteEvento = $auth->createPermission('deleteEvento');
        $deleteEvento->description = 'Delete a evento';
        $auth->add($deleteEvento);

        //Add Noticia permission
        //Create
        $createNoticia = $auth->createPermission('createNoticia');
        $createNoticia->description = 'Create Noticia';
        $auth->add($createNoticia);
        //Update
        $updateNoticia = $auth->createPermission('updateNoticia');
        $updateNoticia->description = 'Update Noticia';
        $auth->add($updateNoticia);
        //Delete
        $deleteNoticia= $auth->createPermission('deleteNoticia');
        $deleteNoticia->description = 'Delete Noticia';
        $auth->add($deleteNoticia);


        //Add GestaoRp´s permission
        //Create
        $createRP = $auth->createPermission('createRP');
        $createRP->description = 'Create RP';
        $auth->add($createRP);
        //Update
        $updateRP = $auth->createPermission('updateRP');
        $updateRP->description = 'Update RP';
        $auth->add($updateRP);
        //Delete
        $deleteRP = $auth->createPermission('deleteEvento');
        $deleteRP->description = 'Delete RP';
        $auth->add($deleteRP);


        //Add Bebida permission
        //Create
        $createBebida = $auth->createPermission('createBebida');
        $createBebida->description = 'Create Bebida';
        $auth->add($createBebida);
        //Update
        $updateBebida = $auth->createPermission('updateBebida');
        $updateBebida->description = 'Update Bebida';
        $auth->add($updateBebida);
        //Delete
        $deleteBebida = $auth->createPermission('deleteBebida');
        $deleteBebida->description = 'Delete Bebida';
        $auth->add($deleteBebida);


        //Add Comprar permission
        //Comprar
        $comprarPulseira = $auth->createPermission('comprarPulseira');
        $comprarPulseira->description = 'Comprar pulseira/VIP para evento';
        $auth->add($comprarPulseira);

    //----------------------------- Add Permission --------------------------------//

        $auth->add($gestor);
        $auth->addChild($gestor, $createEvento, $updateEvento, $deleteEvento, $createBebida, $createNoticia, $createRP, $updateBebida, $updateNoticia, $updateRP, $deleteBebida, $deleteNoticia, $deleteRP);

        $auth->add($admin);
        $auth->addChild($admin, $gestor);

        $auth->add($rp);
        //$auth->addChild();

        $auth->add($cliente);
        $auth->addChild($cliente, $comprarPulseira);

        $auth->add($seguranca);
        
    //-----------------------------------------------------------------------------//

        $auth->assign($admin, 1);

    }
}