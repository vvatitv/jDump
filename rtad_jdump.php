<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.event.helper' );

if( file_exists( JPATH_SITE.'/plugins/system/rtad_jdump/vendor/autoload.php' ) ) {
    require_once( JPATH_SITE.'/plugins/system/rtad_jdump/vendor/autoload.php' );
} else {
    JError::raiseNotice( 20, 'The Plugin needs autoload.php for enable function.' );
}

if(!function_exists('is_json')){
	function is_json($string){
		return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
   	}
}

class plgSystemRtadJdump extends JPlugin {
    function __construct(& $subject, $params) {
        parent::__construct($subject, $params);
    }
	function onAfterRender(){}
}