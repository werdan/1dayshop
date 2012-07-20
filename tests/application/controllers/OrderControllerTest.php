<?php
require_once 'Zend/Test/PHPUnit/BaseControllerTestCase.php';
require_once 'controllers/IndexController.php';

class OrderControllerTest extends Zend_Test_PHPUnit_BaseControllerTestCase {
 
   function testNewOrder() {
       $customer = new Customer();
       $customer->email = "somemail@domain.com";
       $customer->save();
       
       $this->request
           ->setMethod('POST')
           ->setPost(array(
                 'email' => 'somemail@domain.com',
                 'name' => "Ivan",
                 'phone' => "123"
             ));
             
       $this->dispatch('/order/');    
       $this->assertResponseCode(302);
       $cust = Customer::findByEmail('somemail@domain.com');
       $this->assertTrue("Ivan" == $cust->name);
   }

}