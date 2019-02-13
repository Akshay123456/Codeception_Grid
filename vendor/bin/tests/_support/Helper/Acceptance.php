<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
   public function _depends()
    {
        return ['Codeception\Module\PhpBrowser' => 'PhpBrowser is a mandatory dependency of TestHelper'];
    }

    public function _inject(\Codeception\Module\PhpBrowser $phpBrowser)
    {
        $this->phpBrowser = $phpBrowser;
    }
}
