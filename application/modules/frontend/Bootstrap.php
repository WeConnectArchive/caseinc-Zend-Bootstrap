<?php
require_once("App/Application/Module/Bootstrap.php");
class Frontend_Bootstrap extends App_Application_Module_Bootstrap
{
  protected function _initAppAutoload()
  {
   
    
    $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => dirname(__FILE__),
    ));

    return $autoloader;
  }

}

