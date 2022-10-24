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

        //Ver dados estatísticos do seu código permission
        $verdadosEstatisticosCodigo = $auth->createPermission('verdadosEstatisticosCodigo');
        $verdadosEstatisticosCodigo->description = 'Ver dados estatísticos do seu código de RP';
        $auth->add($verdadosEstatisticosCodigo);


        //Add Comprar permission
        //Comprar
        $comprarPulseira = $auth->createPermission('comprarPulseira');
        $comprarPulseira->description = 'Comprar pulseira/VIP para evento';
        $auth->add($comprarPulseira);


        //Add gestão dos empregados permission
        //Create
        $createEmpregado = $auth->createPermission('createEmpregado');
        $createEmpregado->description = 'Create a Empregado';
        $auth->add($createEmpregado);
        //Update
        $updateEmpregado = $auth->createPermission('updateEmpregado');
        $updateEmpregado->description = 'Update a Empregado';
        $auth->add($updateEmpregado);
        //Delete
        $deleteEmpregado = $auth->createPermission('deleteEmpregado');
        $deleteEmpregado->description = 'Delete a Empregado';
        $auth->add($deleteEmpregado);


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


        //Add Ver dados dos eventos passados permission
        $verDadosEvento = $auth->createPermission('verDadosEventos');
        $verDadosEvento->description = 'Ver dados dos eventos passados';
        $auth->add($verDadosEvento);


        //Add Adicionar fotografias permission
        //Create
        $adicionarFotografica = $auth->createPermission('adicionarFotografica');
        $adicionarFotografica->description = 'Adicionar fotografia';
        $auth->add($adicionarFotografica);
        //Delete
        $deleteFotografica = $auth->createPermission('deleteFotografica');
        $deleteFotografica->description = 'Delete a fotografia';
        $auth->add($deleteFotografica);


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

    //----------------------------- Add Permission --------------------------------//

        $auth->add($gestor);
        $auth->addChild($gestor, $createEvento, $updateEvento, $deleteEvento, $createBebida, $createNoticia, $createRP, $updateBebida, $updateNoticia, $updateRP, $deleteBebida, $deleteNoticia, $deleteRP, $verDadosEvento, $adicionarFotografica, $deleteFotografica);

        $auth->add($admin);
        $auth->addChild($admin, $gestor, $createEmpregado, $updateEmpregado, $deleteEmpregado);

        $auth->add($rp);
        $auth->addChild($rp, $verdadosEstatisticosCodigo);

        $auth->add($cliente);
        $auth->addChild($cliente, $comprarPulseira);

        $auth->add($seguranca);
        
    //-----------------------------------------------------------------------------//

        $auth->assign($admin, 1);

    }
}