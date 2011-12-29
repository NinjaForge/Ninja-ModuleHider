<?php
/*
* The modulehider is designed to allow a user to place a module position with a 
* different style or direction -inside- another module position. 
* On top of this it allows the hider to be opened and shut and remembers
* the open/shut state over pages via a cookie.
* A cookie was chosen to allow it to function for non logged in people. 
* (c) Copyright: Ninjoomla, www.ninjoomla.com - Code so sharp, it hurts.
* email: daniel@ninjoomla.com 
* date: 18 July, 2007
* Release: 1.1
* PHP Code License : http://www.gnu.org/copyleft/gpl.html GNU/GPL 
* JavaScript Code & CSS  : http://creativecommons.org/licenses/by-nc-sa/3.0/
*
* Changelog
*
* 1.2 April 14, 09 : 
*		Bugfix: CSS loader defect.
*
* 1.1 July 19, 07 : 
*       Added a lot of comments to the source (pro version) 
*       Revised the JS to be cleaner and stripped most of it out into a seperate file
*       Included the initial_hidden class to hide the modulehider contents while the JS is loading.       
* 
* 1.0 May 3, 07 : 
*       Initial Version
* 
*/



// ensure this file is being included by a parent file
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// define our function
//if (!class_exists('modModulehider')) {

    	/**
    	* Our modModulehider  namespace. 
    	* All functions are static.
    	*/
//    	class modModulehider  {}
//}

		// get module parameters
		$modids       = $params->get( 'modids' ); 
		$inc_mootools = $params->get('inc_mootools', 1);
		$op_message = $params->get( 'op_message' );
		$cl_message = $params->get( 'cl_message' );
		$top_bot = $params->get( 'top_bot' );
		$inc_css   = $params->get( 'inc_css', '1' );    
		$useLangFile   = $params->get( 'useLangFile', '0' );
		$use_cookie = $params->get( 'use_cookie', '0' );
		$initial_state = $params->get( 'initial_state', '0' );
    
    //if we are using a custom style, then put it into our style parameter, otherwise use the selected one 
		$mod_style = $params->get( 'mod_style', 'xhtml' );
    
    if ($mod_style =='custom')
        $mod_style = $params->get( 'custChrome', 'none' );      
		
		//Explode the modids variable so we can count how many ids we have.
		//the str_replace is to remove any whitespace
		$modIDArray   = explode( ",", str_replace(' ', '',$modids));
		
		//Count the number of array elements - the number of modules to display
		$IDCount      = count( $modIDArray );
		
		// get this module's id to use as a unique identifier.
		// This allows us to have multiple instances on the one page
		$this_id      = $module->id;
		
		//We need to access the acl and my global variables to check permissions
		$user         = JFactory::getUser();
		$acl          = JFactory::getACL();
		$database     = JFactory::getDBO();
		
		$document = JFactory::getDocument();

    //basic url to our media files folder
    $mediaDir = JURI::base().'media/mod_ninjamodulehider';
     
		//Include mootools if required          
    //if ($inc_mootools)
    //  $document->addScript($mediaDir.'/js/mootools.v1.11.js');    
	if((bool)$inc_mootools) JHTML::_('behavior.mootools');
	$document->addScript($mediaDir.'/js/mootools.ninjamodulehider.js');
	
	if ( $inc_css )	
		$document->addStyleSheet($mediaDir.'/css/mod_ninjamodulehider.css', 'text/css', null, array());; 
    
	//this is for if there isn't any JS to unhide the modules. It will only activate if JS is turned off
	$document->addCustomTag('<noscript><style type="text/css"> .initial-hide, .mdlhdr_innr {visibility:visible !important}</style></noscript>');
	
	if($width = $params->get('width')) $document->addStyleDeclaration('#ninja-module-hider-'.$module->id.'{width:'.$width.'}');
		
	if ($useLangFile){
      $cl_message = JText::_('Open Panel');
      $op_message = JText::_('Close Panel');
    }
    
    //Set the JS variables for the hider to use
	$js =  "var mdlhdr_op_message".$this_id." = '".$op_message."'; 
		    var mdlhdr_cl_message".$this_id." = '".$cl_message."';
		    var mdlhdr_use_cookie".$this_id." = '".$use_cookie."';
		    var mdlhdr_initial_state".$this_id." = '".$initial_state."';";
			  
	//$document->addScriptDeclaration($js);
	$options = array(
		'msg' => array(
			'open'  => $op_message,
			'close' => $cl_message
		),
		'open' => (bool) $initial_state,
		'mode' => $params->get( 'mode', 'vertical' )
	);
	if(!$use_cookie) $options['cookie'] = (bool) $use_cookie;
	$document->addScriptDeclaration("window.addEvent('domready', function(){ new NinjaModuleHider('ninja-module-hider-".$module->id."', ".json_encode($options)."); });");
    
    // Load the module helper to help us render our moduls for display.
    require_once dirname(__FILE__).DS.'helper.php';
    
    $layout = ($mod_style == 'horz') ? $mod_style : 'default';
    
    // Buffer the handle to reduce the layout code
    ob_start();
    require JModuleHelper::getLayoutPath('mod_ninjamodulehider', 'handle');
    $module->handle = ob_get_clean();
    
    require	JModuleHelper::getLayoutPath('mod_ninjamodulehider', $layout);