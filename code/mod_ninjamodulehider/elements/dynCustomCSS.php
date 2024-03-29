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
class JElementdynCustomCSS extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'dynCustomCSS';
	
	function fetchTooltip($label, $description, &$node, $control_name, $name) {
		
		$return = '';
		if ( $this->_parent->get('style') == 'custom' ) {
			$return = JText::_($label);
		}	
			
		return $return;
	}
	
	function fetchElement($name, $value, &$node, $control_name)
	{	
		$return = '';
		$rows = $node->attributes('rows');
		$cols = $node->attributes('cols');
		$class = ( $node->attributes('class') ? 'class="'.$node->attributes('class').'"' : 'class="text_area"' );
		// convert <br /> tags so they are not visible when editing
		$value = str_replace('<br />', "\n", $value);
		
		if ( $this->_parent->get('style') == 'custom' ) {
			return '<textarea name="'.$control_name.'['.$name.']" cols="'.$cols.'" rows="'.$rows.'" '.$class.' id="'.$control_name.$name.'" >'.$value.'</textarea>';
		}
		
		return $return;
	}
}