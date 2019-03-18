<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.event.helper' );

if( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once( __DIR__ . '/vendor/autoload.php' );
} else {
    JError::raiseNotice( 20, 'The Plugin needs autoload.php for enable function.' );
}
if(!function_exists('is_json')){
	function is_json($string){
		return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
   	}
}

class plgSystemRtad_jdump extends JPlugin{
    public function __construct(& $subject, $params){
		parent::__construct($subject, $params);
    }
	public function onAfterInitialise(){

		$_WHOOPS = new \Whoops\Run;
		$_WHOOPS->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$_WHOOPS->register();
		
		if ( JFactory::getApplication()->isAdmin() ){
			 return;
		}
		if ( $this->params->get('mootools', 1) == 0 ){
			include ( __DIR__ . '/lib/behavior.php' );
		}
		if ( $this->params->get('jquery', 1) == 0 ){
			include ( __DIR__ . '/lib/jquery.php' );
		}
		if ( $this->params->get('bootstrap', 1) == 0 ){
			include ( __DIR__ . '/lib/bootstrap.php' );
		}

	}
}