<?php 
require_once 'PHPUnit/Extensions/Database/DB/IDatabaseConnection.php';

class CleanInsertSetUpOperation implements PHPUnit_Extensions_Database_Operation_IDatabaseOperation {
     public function execute(PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection, PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet){
        //Recreate all tables
        $manager = Doctrine_Manager::getInstance();
        $tables = $manager->getCurrentConnection()->import->listTables();
        foreach ($tables as $table) {
          $manager->getCurrentConnection()->export->dropTable($table);
        }
        $manager->createDatabases($connection);
        Doctrine::createTablesFromModels($doctrineConfig['models_path']);     
     }
}