<?php

class ImageController extends Zend_Controller_Action
{

    public function init()
    {
    }

    /*
     * Returns full sized image from Blob
     */
    public function fullAction()
    {  

     $id = (int) $this->_request->getQuery('id');
     $currentProduct = Product::findById($id);
     $this->getResponse()->setHeader('Content-type','image/any');
     $this->getResponse()->setHeader('Content-Length',strlen($currentProduct->fullSizedImage));
     $this->getResponse()->appendBody($currentProduct->fullSizedImage);
    }
    
}

