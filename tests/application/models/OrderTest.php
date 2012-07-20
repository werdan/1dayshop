<?php
require_once 'PHPUnit_Extensions_Database_TestCase_CleanReloadDB.php';

class OrderTest extends PHPUnit_Extensions_Database_TestCase_CleanReloadDB {
 
  function testOrderMapping() {
      
      $order = new Order();
      
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      
      //product with start date in future
      $p = new Product();
      $p->name = 'TestName1';
      $p->description = 'Test desciption';
      $p->dateSalesEnd = $currentDate->get();
      $p->dateSalesStart = $currentDate->subDay(1)->get();
      $p->save();
      $currentProduct = Product::getCurrentProduct();
      
      $order->Product = $currentProduct;
      
      $customer = new Customer();
      
      $customer->email = "test@test.com";
      $customer->name = "Test";
      
      $order->Customer = $customer;
      $order->save();
      
      $table = Doctrine::getTable('Order');
      $sameOrder = $table->find($order->id);
      
      PHPUnit_Framework_Assert::assertEquals($sameOrder->Product,$currentProduct);
  }
   
  protected function  getDataSet()
    {
        return $this->createFlatXMLDataSet('/home/ansam/php_workspace/1dayshop2/tests/fixtures/dummy.xml');
    }
}
?>