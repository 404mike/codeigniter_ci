<?php
namespace CodeIgniter;

use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class HomeTest extends CIUnitTestCase
{
    use ControllerTestTrait, DatabaseTestTrait;

    private $greetings;

    protected function setUp(): void
    {
        parent::setUp();

        $this->greeting = new \App\Controllers\Home();
    }

    public function testGreetings()
    {
      $names = [
        'Dylan',
        'Mike',
        'Sara',
        'Gethin'
      ];

      foreach($names as $namesKey => $namesVal) {
        $response = $this->greeting->getName($namesVal);

        $this->assertEquals("Oh, hi $namesVal", $response);
      }
    }

    public function testCheckUserPermissionFail()
    {
      $name = "Boris";
      $response = $this->greeting->checkUserPermission($name);

      $this->assertEquals("Go away", $response);
    }

    public function testCanHaveMortgage()
    {
      // list of applicants
      $applicants = [
        ['age' => 35, 'income' => 30000, 'creditRating' => 40, 'approved' => true, 'message' => 'welcome'],
        ['age' => 17, 'income' => 200, 'creditRating' => 0, 'approved' => false, 'message' => 'too young'],
        ['age' => 47, 'income' => 22000, 'creditRating' => 5, 'approved' => false, 'message' => 'bad credit rating'],
      ];

      foreach($applicants as $applicantKey => $applicantVal) {

        $response = $this->greeting->canHaveMortgage($applicantVal);

        // check message response
        $this->assertEquals($applicantVal['message'], $response['message']);

        // check approved response
        $this->assertEquals($applicantVal['approved'], $response['approved']);

      }
    }
}