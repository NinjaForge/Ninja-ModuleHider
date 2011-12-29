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
class JElementdynXML extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'dynXML';
	
	function fetchTooltip($label, $description, &$node, $control_name, $name) {
		echo '';
	}
	
	function fetchElement($name, $value, &$node, $control_name)
	{	
		jimport('joomla.html.pane');
        // TODO: allowAllClose should default true in J!1.6, so remove the array when it does.
		$panel = &JPane::getInstance('sliders');
		
		$return = '';
		
		if ( $this->_parent->get('dynXMLStyle') ) {
			$return .= '</td></tr></tbody></table>';
			$return .= $panel->endPanel();
		}
		
		$id 	= JRequest::getVar( 'id', 0, 'method', 'int' );
		if (!$id) { 
			$id = reset(JRequest::getVar( 'cid', array(0))); 
		}
		$db 	=& JFactory::getDBO();
		
		$query = 'SELECT params'
		. ' FROM #__modules'
		. ' WHERE id ='. $id;
		$db->setQuery( $query );
		$values = $db->loadResult();
		
		$dynXML = new JParameter($values, JPATH_ROOT.DS.'modules'.DS.'mod_ninjaslide'.DS.'tmpl'.DS.$this->_parent->get('layout').'.xml');
		
		if ( $this->_parent->get('dynXMLStyle') ) {
			$return .= $panel->startPanel(JText :: sprintf('LAYOUTPARAMS', $this->_parent->get('layout'), $this->_parent->get('style')), "layout");
		}
		
		$return .= $dynXML->render('params');
		if ( $this->_parent->get('dynXMLStyle') ) {
			$return .= '<table class="paramlist admintable" width="100%" cellspacing="1"><tbody>';
		}
	
		
		return $return;
	}
}