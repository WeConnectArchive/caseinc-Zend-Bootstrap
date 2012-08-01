<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("Zend/Application/Module/Bootstrap.php");
/**
 * Description of Bootstrap
 *
 * @author cape
 */
class App_Application_Module_Bootstrap extends Zend_Application_Module_Bootstrap{
    
  public function __construct($application)
  {
    parent::__construct($application);
    $this->_loadModuleConfig();
  }


  protected function _loadModuleConfig()
  {
   
    $configFile = APPLICATION_PATH 
        . '/modules/' 
        . strtolower($this->getModuleName()) 
        . '/configs/module.ini';

    if (!file_exists($configFile)) {
        return;
    }

    $config = new Zend_Config_Ini($configFile, $this->getEnvironment());
    $this->setOptions($config->toArray(),1);
    

  }
}