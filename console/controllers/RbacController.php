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
        
        //Add Comprar permission
        //Comprar
        $comprarPulseira = $auth->createPermission('comprarPulseira');
        $comprarPulseira->description = 'Comprar pulseira/VIP para evento';
        $auth->add($comprarPulseira);

    //----------------------------- Add Permission --------------------------------//

        $auth->add($gestor);
        $auth->addChild($gestor, $createEvento, $updateEvento, $deleteEvento);

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