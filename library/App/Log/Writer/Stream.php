<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("Zend/Log/Writer/Stream.php");
/**
 * Description of SStream
 *
 * @author cape
 */
class App_Log_Writer_Stream extends Zend_Log_Writer_Stream{
   /**
     * Class Constructor
     *
     * @param array|string|resource $streamOrUrl Stream or URL to open as a stream
     * @param string|null $mode Mode, only applicable if a URL is given
     * @return void
     * @throws Zend_Log_Exception
     */
    public function __construct($streamOrUrl, $mode = null)
    {
      
        // Setting the default
        if (null === $mode) {
            $mode = 'a';
        }

        if (is_resource($streamOrUrl)) {
            if (get_resource_type($streamOrUrl) != 'stream') {
                require_once 'Zend/Log/Exception.php';
                throw new Zend_Log_Exception('Resource is not a stream');
            }

            if ($mode != 'a') {
                require_once 'Zend/Log/Exception.php';
                throw new Zend_Log_Exception('Mode cannot be changed on existing streams');
            }

            $this->_stream = $streamOrUrl;
        } else {
            if (is_array($streamOrUrl) && isset($streamOrUrl['stream'])) {
                $streamOrUrl = $streamOrUrl['stream'];
            }
            
            
              if (! $this->_stream = @fopen($streamOrUrl, $mode, false)) {

                  require_once 'Zend/Log/Exception.php';
                  $msg = "\"$streamOrUrl\" cannot be opened with mode \"$mode\"";
                  //throw new Zend_Log_Exception($msg);
                error_log("ERROR!".$msg);
                  return false;

              }
        }

        $this->_formatter = new Zend_Log_Formatter_Simple();
    }
    
    
    
    static public function factory($config)
    {
        $config = self::_parseConfig($config);
        $config = array_merge(array(
            'stream' => null,
            'mode'   => null,
        ), $config);

        $streamOrUrl = isset($config['url']) ? $config['url'] : $config['stream'];

        return new self(
            $streamOrUrl,
            $config['mode']
        );
    }
}
