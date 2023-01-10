<?php


namespace frontend\tests\Unit;

use frontend\tests\UnitTester;
use \common\models\Tarefas;

class TarefasTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testFailValidation()
    {
        $Tarefas = new Tarefas();

        $Tarefas->descricao = null;
        $this->assertFalse($Tarefas->validate(['descricao']));

        $Tarefas->descricao = "BrJMzpAkyzQqzCuolewKJDxwXtzDXxxtTOFKWZoIZtarouzDXxxtTOFKWZoIZtarouzDXxxtTOFKWZoIZtarouHNevO";
        $this->assertFalse($Tarefas->validate(['descricao']));

        $Tarefas->descricao = 1;
        $this->assertFalse($Tarefas->validate(['descricao']));

        $Tarefas->descricao = 1.5;
        $this->assertFalse($Tarefas->validate(['descricao']));


        $Tarefas->feito = null;
        $this->assertFalse($Tarefas->validate(['feito']));
        

        $Tarefas->id_user = null;
        $this->assertFalse($Tarefas->validate(['id_user']));

        $Tarefas->id_user = 'teste';
        $this->assertFalse($Tarefas->validate(['id_user']));

        $Tarefas->id_user = 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;
        $this->assertFalse($Tarefas->validate(['id_user']));
    }

    public function testCorretValidation()
    {
        $Tarefas = new Tarefas();

        $Tarefas->descricao = "tarefa";
        $this->assertTrue($Tarefas->validate(['descricao']));

        $Tarefas->feito ='true';
        $this->assertTrue($Tarefas->validate(['feito']));

        $Tarefas->id_user = 1;
        $this->assertTrue($Tarefas->validate(['id_user']));

    }   

    function testAddBDValidation()
    {
        //Create
        $Tarefas = new Tarefas();

        $descricao = "tarefa";
        $feito = 0;
        $id_user = 1;

        $Tarefas->descricao = $descricao;
        $Tarefas->feito = $feito;
        $Tarefas->id_user = $id_user;

        $Tarefas->save();

        $this->tester->seeRecord("common\models\Tarefas", ["descricao" => $descricao, "feito" => $feito] );

        $id = $Tarefas->id;


        //update
        $Tarefas = Tarefas::FindOne(['id'=>$id]);

        $descricao = "tarefa2";
        $feito = 1;

        $Tarefas->descricao = $descricao;
        $Tarefas->feito = $feito;


        $Tarefas->save();

        $this->tester->seeRecord("common\models\Tarefas", ["id" => $id, "descricao" => $descricao, "feito" => $feito]);


        //Delete
        $Tarefas = Tarefas::FindOne(['id'=>$id])->delete();

        $this->tester->dontSeeRecord("common\models\Tarefas", ["id" => $id, "descricao" => $descricao]);

    }

}
