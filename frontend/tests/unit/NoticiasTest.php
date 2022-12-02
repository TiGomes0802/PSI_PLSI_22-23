<?php

namespace frontend\tests\Unit;

use frontend\tests\UnitTester;

class NoticiasTest extends \Codeception\Test\Unit
{
    public function testFailValidation()
    {
        $noticias = new \common\models\Noticias();

        $noticias->titulo = null;
        $this->assertFalse($noticias->validate(['titulo']));

        $noticias->titulo = 'SUCG5KVSxel1JOsWU6LCcPANo1';
        $this->assertFalse($noticias->validate(['titulo']));

        $noticias->titulo = 112412;
        $this->assertFalse($noticias->validate(['titulo']));


        $noticias->datanoticia = null;
        $this->assertFalse($noticias->validate(['datanoticia']));

        $noticias->datanoticia = 'data da noticia';
        $this->assertFalse($noticias->validate(['datanoticia']));

        $noticias->datanoticia = 1231415;
        $this->assertFalse($noticias->validate(['datanoticia']));


        $noticias->descricao = null;
        $this->assertFalse($noticias->validate(['descricao']));

        $noticias->descricao = 'wQDVH84UrXsoatHTspUxdM5gFICuRrJD0mVPbUACwSYW7On4tBvR6KsQG7el1fTHXANs9Jfj405CjKUIIGK8DVqRe9vXkYXHrbRNJfogWICfAsRYP8oHzhLOSWZxmbnzFe0EZgbxpSogo9dVm2DxUFMzOBkZb1jSLKdWd9sJYqLCaIRgQrHTAhCnk0AnkvYsFN9Jz2jZ9Plqs1UIHHveean8yQh414L7GaRiXl7ZawoU2gndgDJ76XFkHcH';
        $this->assertFalse($noticias->validate(['descricao']));

        $noticias->descricao = 1231415;
        $this->assertFalse($noticias->validate(['descricao']));
        

        $noticias->idcriador = null;
        $this->assertFalse($noticias->validate(['idcriador']));

        $noticias->idcriador = 'testes';
        $this->assertFalse($noticias->validate(['idcriador']));

        $noticias->idcriador = 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;
        $this->assertFalse($noticias->validate(['idcriador']));
    }

    public function testCorrevtValidation()
    {
        $noticias = new \common\models\Noticias();

        $noticias->titulo = 'teste';
        $this->assertTrue($noticias->validate(['titulo']));

        $noticias->datanoticia = date_create()->format('Y-m-d H:i:s');
        $this->assertTrue($noticias->validate(['datanoticia']));
        
        $noticias->descricao = 'descricao'; 
        $this->assertTrue($noticias->validate(['descricao']));
        
        $noticias->idcriador = 1;
        $this->assertTrue($noticias->validate(['idcriador']));
    }
}
