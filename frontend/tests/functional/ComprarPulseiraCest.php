<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class ComprarPulseiraCest
{
    public function _before(FunctionalTester $I)
    {
        
        $I->amOnRoute('/');
        $I->see('Login');
        $I->click('Login');
        
        $I->fillField('#username', 'Xuxas');
        $I->fillField('#password', '123456789');
        $I->click('#login');

        $I->see('Logout');
        $I->see('Eventos');

    }

    public function ComprarPulseriaVipSucesso(FunctionalTester $I)
    {
        $I->click('Eventos');
        $I->see('LISTA DE EVENTOS');
        $I->click('Marron 5');
        $I->see('Comprarpulseira');
        $I->click('#comprarpuls');
        $I->see('10');
        $I->click('Comprar','#comprarvip');
        $I->see('Escolher Bebidas');
        $I->selectOption('#linhafatura-bebidas', 'Vodka');
        $I->selectOption('#linhafatura-bebidas', 'Licor Beirão');
        $I->selectOption('#linhafatura-bebidas', 'Safari');
        $I->selectOption('#linhafatura-bebidas', 'RedBull');
        $I->click('Submit');
        $I->see('PulseiraAdquirida');

    }

    public function ComprarPulseriaNormalSucesso(FunctionalTester $I)
    {
        $I->click('Eventos');
        $I->see('LISTA DE EVENTOS');
        $I->click('Marron 5');
        $I->see('Comprarpulseira');
        $I->click('#comprarpuls');
        $I->click('Comprar');
        $I->see('PulseiraAdquirida');
    }
    
    public function ComprarPulseriaGuest(FunctionalTester $I)
    {
        $I->click('Logout');
        $I->see('Signup');
        $I->see('Login');
        $I->click('Eventos');
        $I->see('LISTA DE EVENTOS');
        $I->click('Marron 5');
        $I->see('Comprarpulseira');
        $I->click('#comprarpuls');
        $I->see('Login');

    }

}

