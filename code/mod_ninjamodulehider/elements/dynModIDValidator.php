<?php
/**
* @version		$Id: author.php 10381 2008-06-01 03:35:53Z pasamio $
* @package		Joomla
* @subpackage	Articles
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

/**
 * Renders a author element
 *
 * @package 	Joomla
 * @subpackage	Articles
 * @since		1.5
 */
class JElementdynModIDValidator extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'dynModIDValidator';
	
	function fetchTooltip($label, $description, &$node, $control_name, $name) {
		
		$return = '';
		if ( $this->_parent->get('modids') ) {
			$return = '<span class="hasTip" id="'.$control_name.$name.'-lbl" title="'.JText::_($label).'::'.JText::_($description).'">'.JText::_($label).'</span>';
		}	
			
		return $return;
	}
	
	function fetchElement($name, $value, &$node, $control_name)
	{	
		$return = '';
		if ( $this->_parent->get('modids') ) {
			//Get the module IDs
			$modids = $this->_parent->get('modids');
			
			//Explode the modids variable so we can count how many ids we have.
    		$modIDforeach = explode( ",", $modids );
    		
    		//Check the entered IDs
    		$cid	    = JRequest::getVar( 'cid', array());
			$id = implode($cid);
			if (!$id) {
			$id			= JRequest::getInt('id');
		    }
    		$count		= count($modIDforeach);
    		$i			= 1;
    		$s			= ',';
    		foreach( $modIDforeach as $m ) {
    			if($count === $i) {
    				$s = '';
    			}
    			
		    	if( $m === $id ) {
		    		$return .= '<span class="hasTip" title="'.JText::_('WARNING1').'::'.JText::_('WARNING1TXT').'" style="color:red;">'.$m.$s.'</span>';
		    	} elseif(!JElementdynModIDValidator::exist($m)) {
		    		$return .= '<span class="hasTip" title="'.JText::_('WARNING2').'::'.JText::_('WARNING2TXT').'" style="color:red;">'.$m.$s.'</span>';
		    	} else {
		    		$return .= '<span class="hasTip" title="'.JText::_('WARNING3').'::'.JText::_('WARNING3TXT').'" style="color:green;">'.$m.$s.'</span>';
		    	}
		    $i++;
		    }
		}
		
		return $return;
	}
	
/****
* Check if module exist
****/
	function exist( $id ) {
		
			//We need the databaseloaded to do our query
			$database     = &JFactory::getDBO();
		
			$query    = "SELECT *" 
						. "\n FROM #__modules AS m"
						. "\n where m.id = '" . $id . "' "
						. "\n AND m.client_id != 1";

            $database->setQuery( $query );
            $exist  = $database->loadResult();
		 
		return $exist;
	
	}//exist function
}