<?php

class OrderController extends Zend_Controller_Action
{

    public function init()
    {
       if (( (int) $this->getRequest()->getParam('ajaxForm') ) == 1) {
          $this->_helper->layout()->setLayout('default');
          $this->view->assign('ajaxForm',true);
       } else {
          $this->_helper->layout()->setLayout('index');
       }
    }

    public function indexAction()
    {    
       if ($this->getRequest()->getMethod() == 'POST') {
           //check and save form
           $this->checkOrder();
           $this->saveOrder();
           $this->_redirect('/order/success?ajaxForm=1');
       }
       //TODO What are the other posibilities?
    }  

    public function successAction() {
           $this->view->assign('product',Product::getCurrentProduct());
    }
    
    //TODO Check fields
    private function checkOrder() {
     
    }
    
    private function saveOrder() {
         //TODO Do it in transaction
         $currentDate = new Zend_Date();
         $customer = Customer::findByEmail($this->getRequest()->getParam('email'));
         $customer->name = $this->getRequest()->getParam('name');
         $customer->phone = $this->getRequest()->getParam('phone');

         $ord = new Order();
         $ord->Customer = $customer;
         $ord->date = $currentDate->get();
         //TODO Take product id from param and check if it is available (not in future, still on sales, etc)
         $product = Product::getCurrentProduct();
         $ord->Product = $product;
         $customer->save();
         $ord->save();
         $product->takeFromStock();
         $customer->sendOrderNotification($ord);
    }
}

