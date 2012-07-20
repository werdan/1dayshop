<?php
require_once 'PHPUnit/Extensions/Database/TestCase.php';
require_once 'CleanInsertSetUpOperation.php';

abstract class PHPUnit_Extensions_Database_TestCase_CleanReloadDB extends PHPUnit_Extensions_Database_TestCase {
       
    //TODO This opens the second connection, in addition to already opened in Bootstrap.php
    //Can be changed for $manager->connect() and wrapping it in some class?
    protected function getConnection()
    {
        $doctrineConfig = Zend_Registry::get('doctrineConfig');
        $pdo = new PDO($doctrineConfig['connection_string'], '','');
        $connection = $this->createDefaultDBConnection($pdo,'');
        return $connection;
    }

    protected function getSetUpOperation() {
       return new CleanInsertSetUpOperation();
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