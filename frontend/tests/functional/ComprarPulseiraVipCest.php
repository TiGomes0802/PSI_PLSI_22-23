<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class ComprarPulseiraVipCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Eventos');

    }

    public function ComprarPulseriaVipSucesso(FunctionalTester $I)
    {
        $I->click('Eventos');
        $I->see('LISTA DE EVENTOS');
        $I->click('#seleceevento');
        $I->see('COMPRAR PULSEIRA');
        $I->click('#comprarpuls');
        $I->see('Escolher pulseira');
        $I->click('#comprarvip');
        $I->see('Escolher Bebidas');
        $I->selectOption('#linhafatura-bebidas', 'Vodka');
        $I->selectOption('#linhafatura-bebidas', 'Licor Beirão');
        $I->selectOption('#linhafatura-bebidas', 'Safari');
        $I->selectOption('#linhafatura-bebidas', 'RedBull');
        $I->click('Submit');
    }
}

