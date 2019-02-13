<?php 

use \Codeception\Util\Locator;


class FirstCest  
{

    public function _before(AcceptanceTester $I)
    {	
  		

    }

    public function _after(AcceptanceTester $I)
    {

    }

   public function Check_Authentication_Atlantic_Broadband(AcceptanceTester $I)
	{
		{
			$I->amOnPage('/');
			$I->click('html body div#body-container form input');
			$I->selectOption('//*[@id="dropdownlist"]','Atlantic Broadband (auth.atlanticbb.net)');
			$I->click('.btn');
			$I->wait(10);
			$I->fillfield('//*[@id="username"]','syn11@atlanticbb.net');
			$I->fillfield('//*[@id="password"]','syn@cortest');
			$I->click('//*[@id="login"]'); 
			$I->wait(10);
			$I->seeInTitle('SAML 2.0 SP Demo Example');
		}
	}		

}

  


