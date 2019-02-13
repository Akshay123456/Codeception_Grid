<?php 

use \Codeception\Util\Locator;

//global $Client,$Username,$Password;
//$ini_array = (parse_ini_file("data.ini",true, INI_SCANNER_RAW));
/*$Client = (($ini_array['Atlantic Broadband (auth.atlanticbb.net)']['client']));
$Username = (($ini_array['Atlantic Broadband (auth.atlanticbb.net)']['username']));
$Password = (($ini_array['Atlantic Broadband (auth.atlanticbb.net)']['password']));*/

class FirstCest  
{

    public function _before(AcceptanceTester $I)
    {	
    	//global $Clientname,$Username,$Password;
    	/*$xml=simplexml_load_file("C:/Codeception_Test/tests/acceptance/data.xml") or die("Error: Cannot create object");  	
		$Clientname= $xml->client[0]->name;
		$Username =$xml->client[0]->username;
		$Password =$xml->client[0]->password;	*/
		
		/*function csv_content_parser($content) {
  		foreach (explode("\n", $content) as $line) {
    		// Generator saves state and can be resumed when the next value is required.
    		yield str_getcsv($line);
 		 }
		}	

		// Get content from csv file.
		$content = file_get_contents('your_file.csv');
		// Create one array from csv file's lines.
		$data = array();*/
		/*
		foreach (csv_content_parser($content) as $fields) {
 		 array_push($data, $fields);
		}
		$file = fopen("C:/Codeception_Test/tests/acceptance/data.csv","r");

		while(! feof($file))
  		{
  		$data = array(fgetcsv($file));
  		print_r($data);
  		}

		fclose($file);*/

    }

    public function _after(AcceptanceTester $I)
    {

    }

   public function Check_Authentication_Atlantic_Broadband(AcceptanceTester $I)
	{
		global $Client,$Username,$Password;
		$ini_array = (parse_ini_file("data.ini",true, INI_SCANNER_RAW));
		foreach ($ini_array as $data) {
			$I->amOnPage('/');
			$I->click('html body div#body-container form input');
			$I->selectOption('//*[@id="dropdownlist"]',$data['client']);
			$I->click('.btn');
			$I->fillfield('//*[@id="username"]',$data['username']);
			$I->fillfield('//*[@id="password"]',$data['password']);
			$I->click('//*[@id="login"]'); 
			$I->wait(10);
			$I->seeInTitle('SAML 2.0 SP Demo Example');
			$I->click('/html/body/div[2]/p[4]/a');
		}
	}		

}

  


