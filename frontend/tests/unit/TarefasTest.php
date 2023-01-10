<?php


namespace frontend\tests\Unit;

use frontend\tests\UnitTester;
use common\models\Tarefas;

class TarefasTest extends \Codeception\Test\Unit
{

    public function testFailValidation()
    {
        $Tarefas = new Tarefas();

        $Tarefas->Descricao = null;
        $this->assertFalse($Tarefas->validate(['Descricao']));

        $Tarefas->Descricao = "zuLiiViGNErOvWuFpcdyHMLflcsdsds";
        $this->assertFalse($Tarefas->validate(['Descricao']));

        $Tarefas->Descricao = 1;
        $this->assertFalse($Tarefas->validate(['Descricao']));

        $Tarefas->Descricao = 1.5;
        $this->assertFalse($Tarefas->validate(['Descricao']));

        $Tarefas->Feito = null;
        $this->assertFalse($Tarefas->validate(['Feito']));
    }

    public function testCorretValidation()
    {
        $Tarefas = new Tarefas();

        $Tarefas->Descricao = "Uma tarefa";
        $this->assertTrue($Tarefas->validate(['Descricao']));

        $Tarefas->Feito = 1;
        $this->assertTrue($Tarefas->validate(['Feito']));
        
    }

    function testAddBDValidation()
    {
        //create
        $Tarefas = new Tarefas();

        $descricao = "add tarefa";
        $Feito = 0;

        $Tarefas->Descricao = $descricao;
        $Tarefas->Feito = $Feito;
        $Tarefas->id_utilizador = 1;

        $Tarefas->save();

        $this->tester->seeRecord("common\models\Tarefas", ['Descricao' => $descricao, "Feito" => $Feito, 'id_utilizador' => 1 ]);

        $id = $Tarefas->id;

         //Update

         $Tarefas = Tarefas::findOne(['id'=> $id]);

         $descricao = "add nova";
         $Feito = 1;

        $Tarefas->Descricao = $descricao;
        $Tarefas->Feito = $Feito;
 
         $Tarefas->save();
 
         $this->tester->seeRecord("common\models\Tarefas", ['Descricao' => $descricao, "Feito" => $Feito, 'id_utilizador' => 1 ]);
 
         //Delete
 
         $Tarefas = Tarefas::FindOne(['id'=> $id])->delete();
 
         $this->tester->dontSeeRecord("common\models\Tarefas", ['Descricao' => $descricao, "Feito" => $Feito]);
    }


}
