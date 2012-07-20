<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
       $this->_helper->layout()->setLayout('index');
    }

    public function indexAction()
    {    
     $this->view->assign('title', 'Интернет магазин скидок и распродаж - 1dayshop.com.ua');
     $currentProduct = Product::getCurrentProduct();
     $this->view->assign('currentProduct',$currentProduct);
    }    

    //TODO Zend_Translate
    public function subscribeAction()
    {    
        //TODO Accept only POST requests
        $this->_helper->layout()->setLayout('default');
        //TODO check if can move it to .htaccess
        $this->getResponse()->setHeader('Content-Type', 'text/plain; charset=UTF-8');

        //TODO check email agains pattern
        $customer = Customer::findByEmail((string) $this->getRequest()->getParam('email'));
        $customer->newsletter = true;
        $customer->save();
        $this->view->assign('text','Спасибо, теперь Вы будете получать нашу рассылку. Отписаться можно по ссылке в письмах, которые Вы будете получать');
    }    
    
    
    //TODO don't show products in future
    public function archiveAction() {
     $product = Product::findById((int) $this->getRequest()->getParam('product_id'));
     $date = new Zend_Date();
         var_dump('5555555');
     if ($product->dateSalesStart > $date->get()) {
         $this->_redirect("/");
     }
     $this->view->assign('currentProduct',$product);
     $this->renderScript('index/index.phtml');
    }
    
    public function insiderAction() {}
    
    public function tomorrowtimestampAction() {
        $date = new Zend_Date();
        $date->set('00:00:01',Zend_Date::TIMES);
        $date->addDay(1);
        echo $date->get();
        die;
    }
}

