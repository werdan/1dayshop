<?php

class RssController extends Zend_Controller_Action
{

    public function init()
    {
       $this->_helper->layout()->setLayout('default');
    }

    public function indexAction()
    {    
     //TODO put 3 - in application properties;
     $rssProducts = Product::getRecentProducts(3);
     $entries = array();
     foreach ($rssProducts as $rssProduct) {
       $entry = array(
          'title'       => $rssProduct->name.' со скидкой '. $rssProduct->getDiscount() . '%',
          'link'        => "http://1dayshop.com.ua/index/archive/".$rssProduct->id."/",
          'description' => $rssProduct->description,
       );
       $entries[] = $entry;
     }
      $rss = array(
       'title'   => 'Один товар - один день - самая лучшая цена!',
       'link'    => 'http://1dayshop.com.ua/',
       'charset' => 'UTF-8',
       'entries' => $entries
      );
     
      // Import the array
      $feed = Zend_Feed::importArray($rss, 'rss');
     
     // Write the feed to a variable
     $rssFeed = $feed->saveXML();
     $this->view->assign('rss',$rssFeed);     
    }    


}

