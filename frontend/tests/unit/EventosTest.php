<?php

namespace frontend\tests\Unit;

use frontend\tests\UnitTester;
use DateTime;

class EventosTest extends \Codeception\Test\Unit
{
    public function testFailValidation()
    {
        $Evento = new \common\models\Eventos();

        $Evento->nome = null;
        $this->assertFalse($Evento->validate(['nome']));

        $Evento->nome = 'Jwqze3NaLx7F4ho9vkVyfJVrmG';
        $this->assertFalse($Evento->validate(['nome']));

        $Evento->nome = 12345;
        $this->assertFalse($Evento->validate(['nome']));


        $Evento->descricao = null;
        $this->assertFalse($Evento->validate(['descricao']));

        $Evento->descricao = '5zyXzTLjFnW0e5yj81YLZ5RIxC6ReAfVpsxYTNm5djksLYVWxBpo2vH8Fv1xDnkDelkzWeu4nMBfnjzpFPH6As279nZqFRwTaXhQfDOQKtIERLEtQSs9JEIYA291UUwzaZUDrhY0b8Q1rqIh1TbZDzIY31Pp7IomlivdMDdqQ3GEePEBYwSJNYUcFq43YMBsesb8tDMOnbD3BdoN7WXtyKhhMqUPh002EfNmTEbwclpSuvfKtwkxqfyl6dQmIbQm1H6bomWETwvH1VTq8daoyv34SUE9ck1E0qICB3uauHY6hL9TshMN9o889Mg2vd4wCPBZfZ6CzkkeszYQAfnwY0Mw0nOlvb7Iue5kxg6yo7bZma7QNt2zA58iBgMenwlONz4ZwzaZeLulW6rnnYRcNfhNBloA8e7fwr2RCnOovSZevNDzJVHN2NfoyLfw6jrw8ebsVb9nOam0Q0YRhk78OoxiEQfhg36p7PgPgFF2ufS0MncCjz5dY0ibHiZzTYkpzULEoYNbxewbHn90wYHsZwtJE8yTwLMffz45Shna7X8p3gHF5hJfCZnTPw1GxMwgT40NYOwGy3H8nrjU1rn5VWEnMrVcvOXVoihNI8VYpyewShzRNrfo0nNYepGMSEuA7t7fgKQQXrxuaDMDr0LTW5X482GsTpAdXkSM7SEpnkJRsUN1BnzVeUG3BZdquD3Az28ZFJIDzmnMuWvKLoFfn2iTDZfu7hLTbL4MOOpMT4X9kjY';
        $this->assertFalse($Evento->validate(['descricao']));


        $Evento->cartaz = null;
        $this->assertFalse($Evento->validate(['cartaz']));
        
        $Evento->cartaz = '4GNXkqcajSh6mhdLTAit5nvvzdhf1OwP793HcRu6vhw7L3Px6B0wBR6HKiKDt0EOUwnpeuWqWZnZ2RK4K6mvjnrzKmHTCFs6eIov5sqoKNoXOF03CAvFLKS15Uc8iRcGAwZzNjtqkEIF8sQDTx0hv9Ewmww4aLNgAUkNvjmQRXSpOSDJatjKb36NopttzHto9JLI9SuH6zLnPmNvXOX2K4KWghnt5pBfqplgLaCSr2JPDokt1Lyvp5rwLMe';
        $this->assertFalse($Evento->validate(['cartaz']));

        $Evento->cartaz = 231412;
        $this->assertFalse($Evento->validate(['cartaz']));


        $Evento->dataevento = null;
        $this->assertFalse($Evento->validate(['dataevento']));

        $Evento->dataevento = 1235;
        $this->assertFalse($Evento->validate(['dataevento']));

        $Evento->dataevento = 'teste';
        $this->assertFalse($Evento->validate(['dataevento']));


        $Evento->numbilhetesdisp = null;
        $this->assertFalse($Evento->validate(['numbilhetesdisp']));

        $Evento->numbilhetesdisp = 751;
        $this->assertFalse($Evento->validate(['numbilhetesdisp']));


        $Evento->preco = null;
        $this->assertFalse($Evento->validate(['preco']));

        $Evento->preco = '1teste';
        $this->assertFalse($Evento->validate(['preco']));

        $Evento->preco = '12,21';
        $this->assertFalse($Evento->validate(['preco']));


        $Evento->id_criador = null;
        $this->assertFalse($Evento->validate(['id_criador']));

        $Evento->id_criador = 'teste';
        $this->assertFalse($Evento->validate(['id_criador']));

        $Evento->id_criador = 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;
        $this->assertFalse($Evento->validate(['id_criador']));


        $Evento->id_tipo_evento = null;
        $this->assertFalse($Evento->validate(['id_tipo_evento']));

        $Evento->id_tipo_evento = 'teste';
        $this->assertFalse($Evento->validate(['id_tipo_evento']));

        $Evento->id_tipo_evento = 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;
        $this->assertFalse($Evento->validate(['id_tipo_evento']));
    }

    public function testCorretValidation()
    {
        $Evento = new \common\models\Eventos();

        $Evento->nome = "nome";
        $this->assertTrue($Evento->validate(['nome']));

        $Evento->descricao = "descricao";
        $this->assertTrue($Evento->validate(['descricao']));

        $Evento->cartaz = "cartaz";
        $this->assertTrue($Evento->validate(['cartaz']));

        $date = new DateTime();
        $date = $date->format('Y-m-d');
        $Evento->dataevento = $date;
        $this->assertTrue($Evento->validate(['dataevento']));

        $Evento->numbilhetesdisp = 543;
        $this->assertTrue($Evento->validate(['numbilhetesdisp']));

        $Evento->preco = 23.12;
        $this->assertTrue($Evento->validate(['preco']));

        $Evento->id_criador = 1;
        $this->assertTrue($Evento->validate(['id_criador']));

        $Evento->id_tipo_evento = 1;
        $this->assertTrue($Evento->validate(['id_tipo_evento']));

        $Evento->imageFile = null;
        $this->assertTrue($Evento->validate(['imageFile']));
    }

    public function testAddBDValidation()
    {
        $Evento = new \common\models\Eventos();

        $nome = "nome";
        $descricao = "descricao";
        $cartaz = "cartaz";
        $date = new DateTime();
        $date = $date->format('Y-m-d');
        $dataevento = $date;
        $numbilhetesdisp = 500;
        $preco = 12.32;
        $id_criador = 1;
        $id_tipo_evento = 1;

        $Evento->nome = $nome;
        $Evento->descricao = $descricao;
        $Evento->cartaz = $cartaz;
        $Evento->dataevento = $dataevento;
        $Evento->numbilhetesdisp = $numbilhetesdisp;
        $Evento->preco = $preco;
        $Evento->id_criador = $id_criador;
        $Evento->id_tipo_evento = $id_tipo_evento;
        $Evento->save();

        $this->tester->seeRecord('common\models\Eventos', ['nome' => $nome, 'descricao' => $descricao, 'cartaz' => $cartaz, 'numbilhetesdisp' => $numbilhetesdisp, 'preco' => $preco, 'id_criador' => $id_criador, 'id_tipo_evento' => $id_tipo_evento]);
    
        $id = $Evento->id;

        //Update
        $Evento = Eventos::findOne(['id' => $id]);

        $nome = "Outro Nome";
        $descricao = "Outra Descricao";
        $cartaz = "Outro Cartaz";
        $date = new DateTime();
        $date = $date->format('Y-m-d');
        $dataevento = $date;
        $numbilhetesdisp = 250;
        $preco = 25;
        $id_criador = 1;
        $id_tipo_evento = 1;

        $Evento->nome = $nome;
        $Evento->descricao = $descricao;
        $Evento->cartaz = $cartaz;
        $Evento->dataevento = $dataevento;
        $Evento->numbilhetesdisp = $numbilhetesdisp;
        $Evento->preco = $preco;
        $Evento->id_criador = $id_criador;
        $Evento->id_tipo_evento = $id_tipo_evento;
        $Evento->save();

        $this->tester->seeRecord('common\models\Eventos', ['nome' => $nome, 'descricao' => $descricao, 'cartaz' => $cartaz, 'numbilhetesdisp' => $numbilhetesdisp, 'preco' => $preco, 'id_criador' => $id_criador, 'id_tipo_evento' => $id_tipo_evento]);

        //Delete
        Eventos::findOne(['id' => $id])->delete();

        $this->tester->dontSeeRecord('common\models\Eventos', ['nome' => $nome, 'descricao' => $descricao, 'cartaz' => $cartaz, 'numbilhetesdisp' => $numbilhetesdisp, 'preco' => $preco, 'id_criador' => $id_criador, 'id_tipo_evento' => $id_tipo_evento]);    
    }
}