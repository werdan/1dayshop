<?php
require_once 'PHPUnit_Extensions_Database_TestCase_CleanReloadDB.php';

class CustomerTest extends PHPUnit_Extensions_Database_TestCase_CleanReloadDB {
 
  function testFindByEmailNewEmail() {
      $customer = Customer::findByEmail('nosuchmail@mail.com');
      PHPUnit_Framework_Assert::assertTrue($customer instanceof Customer);
  }

  function testFindByEmailExistingEmail() {
      
      $customer = new Customer();
      $customer->email = "mail@mail.com";
      $customer->name = "Ivanov";
      $customer->save();
      $c2 = Customer::findByEmail("mail@mail.com");
//      $this->printDoctrineProfiler();
      PHPUnit_Framework_Assert::assertTrue("Ivanov" == $c2->name);
  }
  
  
  function testSendOrderNotification() {
      PHPUnit_Framework_Assert::assertTrue(false,"TBD");
  }
  
  protected function  getDataSet()
    {
        return $this->createFlatXMLDataSet('/home/ansam/php_workspace/1dayshop2/tests/fixtures/dummy.xml');
    }
    
    
}
?>