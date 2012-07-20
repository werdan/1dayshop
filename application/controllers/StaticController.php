<?php

class StaticController extends Zend_Controller_Action
{

    public function init()
    {
       $this->_helper->layout()->setLayout('index');
    }
    
    public function faqAction(){
       $this->view->assign('title', 'Вопросы и ответы - 1dayshop.com.ua');
    }
    public function shippingAction(){
       $this->view->assign('title', 'Доставка - 1dayshop.com.ua');
    }
    public function contactusAction(){
     $this->view->assign('title', 'Как с нами связаться? - 1dayshop.com.ua');
    }
    public function aboutAction(){
     $this->view->assign('title', 'О проекте - 1dayshop.com.ua');
    }
    public function partnersAction(){
     $this->view->assign('title', 'Поставщикам - 1dayshop.com.ua');
    }
    
}

