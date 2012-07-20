<?php
require_once 'Zend/Test/PHPUnit/BaseControllerTestCase.php';
require_once 'controllers/IndexController.php';

class IndexControllerTest extends Zend_Test_PHPUnit_BaseControllerTestCase {
 
   function testSubscribeToNewsletter() {
       $customer = Customer::findByEmail("somemail@domain.com");
       $this->assertTrue(null == $customer->id);       
       $this->request
           ->setMethod('POST')
           ->setPost(array(
                 'email' => 'somemail@domain.com'
             ));
       $this->dispatch('/index/subscribe');      
       $content = $this->response->outputBody();
       $this->assertResponseCode(200,$content);
       $this->assertAction('subscribe');
       $customer = Customer::findByEmail("somemail@domain.com");
       //$this->printDoctrineProfiler();
       $this->assertTrue(null != $customer->id);
       $this->assertTrue($customer->newsletter);
   }

   function testArchiveActionProductInFuture() {
      $this->reset();
      parent::setUp();
      
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      
      //product with start date in future
      $p = new Product();
      $p->name = 'TestName1';
      $p->description = 'Test desciption';
      $p->dateSalesStart = $currentDate->addDay(5)->get();
      $p->dateSalesEnd = $currentDate->addDay(1)->get();
      $p->save();
      
      $date2 = new Zend_Date();
      $this->assertTrue(null != $p->id);
      $this->assertTrue($currentDate->get() > $date2->get());
//      $this->request
//           ->setGet(array(
//                 'product_id' => $p->id
//             ));
      $this->dispatch("/index/archive");
      var_dump($this->getResponse()->getHttpResponseCode);
      $this->assertResponseCode(302);
   }
}