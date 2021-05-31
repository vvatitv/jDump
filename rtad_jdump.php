<?php

defined( '_JEXEC' ) or die();

class plgSystemRtad_jdump extends JPlugin {

    private $_CONFIG;
    private $_APP;

    public function __construct($subject, $params){

        $this->_APP = JFactory::getApplication();
        $this->_CONFIG = JFactory::getConfig();

        parent::__construct($subject, $params);
    }

	public function onAfterInitialise(){

        if( file_exists(__DIR__ . '/vendor/autoload.php') ) {
            require_once __DIR__ . '/vendor/autoload.php';
        } else {
            JError::raiseNotice(20, JText::_('PLG_SYSTEM_RTAD_JDUMP_AUTOLOAD_ERROR'));
        }

		error_reporting(E_ALL);
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');

        if( $this->params->get('jdump_show_notice', 0) == 0 && $this->params->get('jdump_show_warning', 0) == 1 ){
			error_reporting(E_ALL & ~E_NOTICE);
        }
        if( $this->params->get('jdump_show_warning', 0) == 0 && $this->params->get('jdump_show_notice', 0) == 1 ){
			error_reporting(E_ALL & ~E_WARNING);
        }
        if( $this->params->get('jdump_show_warning', 0) == 0 && $this->params->get('jdump_show_notice', 0) == 0 ){
        	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
        }

        if( $this->params->get('jdump_use_error_reporting', 1) == 1 ){
			if( $this->_CONFIG->get('error_reporting', 'default') == $this->params->get('jdump_use_error_reporting_level', 'development') ){	            
				$_WHOOPS = new \Whoops\Run;
				$_WHOOPS->pushHandler(new \Whoops\Handler\PrettyPageHandler);
				$_WHOOPS->register();
			}
        }else{
			$_WHOOPS = new \Whoops\Run;
			$_WHOOPS->pushHandler(new \Whoops\Handler\PrettyPageHandler);
			$_WHOOPS->register();
        }
		
		if ( JFactory::getApplication()->isAdmin() ){
			 return;
		}

		if ( $this->params->get('jdump_lib_mootools', 1) == 0 ){
			require_once __DIR__ . '/library/behavior.php';
		}
		if ( $this->params->get('jdump_lib_jquery', 1) == 0 ){
			require_once __DIR__ . '/library/jquery.php';
		}
		if ( $this->params->get('jdump_lib_bootstrap', 1) == 0 ){
			require_once __DIR__ . '/library/bootstrap.php';
		}
    }
}