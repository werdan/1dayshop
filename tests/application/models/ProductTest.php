<?php
require_once 'PHPUnit_Extensions_Database_TestCase_CleanReloadDB.php';

class ProductTest extends PHPUnit_Extensions_Database_TestCase_CleanReloadDB {
 
  function testGetCurrentProductBeforeSales() {
          
      $currentProduct = Product::getCurrentProduct();
      PHPUnit_Framework_Assert::assertNull($currentProduct->id);

      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      
      //product with start date in future
      $p = new Product();
      $p->name = 'TestName1';
      $p->description = 'Test desciption';
      $p->dateSalesEnd = $currentDate->get();
      $p->dateSalesStart = $currentDate->addDay(5)->get();
      $p->save();

      $currentProduct = Product::getCurrentProduct();
      PHPUnit_Framework_Assert::assertNull($currentProduct->id);

  }

  function testGetCurrentProduct() {

      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
   
      //Correct product
      $p = new Product();
      $p->name = 'TestName6';
      $p->description = 'Test description';
      $p->dateSalesStart = $currentDate->get();
      $p->dateSalesEnd = $currentDate->get();
      $p->save();
      $currentProduct = Product::getCurrentProduct();
      PHPUnit_Framework_Assert::assertNotNull($currentProduct->id,'Expecting correct product');
  }
  
  function testGetCurrentProductAfterSales() {
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
   
   
   //Product that ends sales in the past
      $p = new Product();
      $p->name = 'TestName3';
      $p->description = 'Test desciption';
      $p->dateSalesStart = $currentDate->get();
      $p->dateSalesEnd = $currentDate->subDay(10)->get();
      $p->save();

      $pId2 = Product::findById(2);
      
      $currentProduct = Product::getCurrentProduct();
//      $this->printDoctrineProfiler();
      PHPUnit_Framework_Assert::assertNull($currentProduct->id);
  }

  
  function testThreeActualProducts() {
     //Test what product will be selected if there are several that meet required getCurrentProduct() criteria
     /*
      * For example:
      * 
      *            12.01.10--13.01.10--14.01.10--15.01.10--16.01.10---17.01.10
      * Product1:     + -------------------+
      * Product2:               +------------------------------+
      * Product3:  ----------------------------------+
      * 
      *                                    ^^
      *                                    We check now and three product can be shown. 
      *                                    we should returns the one that started sales latest (Product2)
      */  
      $p = new Product();
      $p->name = 'Product1';
      $p->description = 'Test desciption';
      
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      $p->dateSalesStart = $currentDate->subDay(2)->get();
      
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      $p->dateSalesEnd = $currentDate->addDay(1)->get();
      $p->save();
      
      $p = new Product();
      $p->name = 'Product2';
      $p->description = 'Test desciption';
      
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      $p->dateSalesStart = $currentDate->subDay(1)->get();
      
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      $p->dateSalesEnd = $currentDate->addDay(2)->get();
      $p->save();
      
      $correctId = $p->id;
      
      $p = new Product();
      $p->name = 'Product3';
      $p->description = 'Test desciption';
      
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      $p->dateSalesStart = $currentDate->subDay(5)->get();
      
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
      $p->dateSalesEnd = $currentDate->addDay(1)->get();
      $p->save();
   
      $cp = Product::getCurrentProduct();
      
      PHPUnit_Framework_Assert::assertEquals($correctId, $cp->id, 'TBD');
  }
  
  function testFindById() {
      $currentDate = new Zend_Date();
      $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
   
      $p = new Product();
      $p->name = 'TestName4';
      $p->description = 'Test desciption';
      $p->dateSalesStart = $currentDate->get();
      $p->dateSalesEnd = $currentDate->get();
      $p->save();      
      $loadedProduct = Product::findById($p->id);
      PHPUnit_Framework_Assert::assertEquals($p->id,$loadedProduct->id);
  }
      
    
  protected function  getDataSet()
    {
        return $this->createFlatXMLDataSet('/home/ansam/php_workspace/1dayshop2/tests/fixtures/product.xml');
    }
}
?>