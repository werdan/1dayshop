<?php

/**
 * Product
 *  
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Product extends BaseProduct
{
    
    public function setUp()
    {
        parent::setUp();
        
    }
    
    public function getDiscount() {
        return round(($this->price-$this->priceOriginal)*100/$this->priceOriginal,0);
    }

    public static function getCurrentProduct() {
        $currentDate = new Zend_Date();
        $currentDate = $currentDate->set('00:00:01',Zend_Date::TIMES);
        return Doctrine_Query::create()
             ->from('Product p')
             ->where('p.dateSalesStart <= ? and p.dateSalesEnd >= ?', array($currentDate->get(),$currentDate->get()))
             ->orderBy('p.dateSalesStart DESC')
             ->fetchOne();
        }
    
    public static function findById($id) {
         $table = Doctrine::getTable('Product');
         return $table->find($id);
    }
    
    public function getPathImageFile() {
         return "/images/products/".$this->imageFile;
    }
    
    //TODO Do it in transaction
    public function takeFromStock($quantity = 1) {
         $this->leftInStock = $this->leftInStock - $quantity;
         $this->save();
    }
    
    public function getRecentProducts($number=1) {
         return Doctrine_Query::create()
             ->from('Product p')
             ->orderBy('p.dateSalesStart DESC')
             ->limit($number)
             ->execute();
    }
    
}