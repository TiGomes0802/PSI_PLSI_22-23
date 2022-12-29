<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class CreateNewClienteCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Signup');
        $I->click('Signup');
        $I->see('REGISTAR');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->click('Submit');
        $I->seeValidationError('Nome não pode estar vazio');
        $I->seeValidationError('Apelido não pode estar vazio');
        $I->seeValidationError('Username não pode estar vazio');
        $I->seeValidationError('Password não pode estar vazio');
        $I->seeValidationError('Passwordrepet não pode estar vazio');
        $I->seeValidationError('Email não pode estar vazio');
        $I->seeValidationError('Sexo não pode estar vazio');
        $I->seeValidationError('Datanascimento não pode estar vazio');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        
        $I->fillField('#nome', 'teste');
        $I->fillField('#apelido', 'teste');
        //$I->fillField('#username', 'clarinha');
        $I->fillField('#password', '12345678');
        $I->fillField('#passwordrepet', '12345678');
        $I->fillField('#email', 'teste.email@example.com');
        $I->fillField('#date', '2015/05/02');

        //$I->see('Logout (clarinha)');
        $I->click('Submit');
        $I->seeValidationError('Sexo não pode estar vazio');
        $I->seeValidationError('Precisa ser maior de 18 anos.');
        //$I->seeRecord('common\,models\Userprofile', [
        //    'nome' => 'teste',
        //    'apelido' => 'teste',
        //    'sexo' => 'masculino',
        //    'datanascimento' => '10/12/2000',
        //]);
    }
}
