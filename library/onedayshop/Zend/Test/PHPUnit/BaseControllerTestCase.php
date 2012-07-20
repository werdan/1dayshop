<?php
require_once 'Zend/Application.php';

class Zend_Test_PHPUnit_BaseControllerTestCase extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp()
    {
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
        $this->getFrontController()->setParam('bootstrap', $this->application->getBootstrap());
    }

    public function appBootstrap()
    {
      $this->application = new Zend_Application(
            APPLICATION_ENV, 
            APPLICATION_PATH . '/configs/application.ini'
        );
      $this->application->bootstrap();
    }
        
    protected function printDoctrineProfiler() {
      $profiler=Zend_Registry::get('dbProfiler');
      $time = 0;
      foreach ( $profiler as $event ) {
         $time += $event -> getElapsedSecs ();
         echo $event ->getName () . " [" . sprintf ("%f", $event -> getElapsedSecs ()) . "]\n";
         echo $event ->getQuery () . "\n";
         $params = $event ->getParams ();
         if( ! empty ( $params )) {
             var_dump ( $params );
             echo "\n";
         }
      }
      echo "Total time : " . $time . "\n";
    }
}