<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

/**
 * Renders a slider panel
 */
class JElementPanel extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'panel';
	
	function fetchTooltip($label, $description, &$node, $control_name, $name) {
		echo '';
	}
	
	function fetchElement($name, $value, &$node, $control_name)
	{	
		jimport('joomla.html.pane');
        // TODO: allowAllClose should default true in J!1.6, so remove the array when it does.
		$panel = &JPane::getInstance('sliders');
		
		$return = '';
		
		//Let another param element detirme if the module is shown or hidden
		if ( $this->_parent->get($node->attributes('toggler')) ) {
			$return .= '</td></tr></tbody></table>';
			$return .= $panel->endPanel();
	
			$return .= $panel->startPanel(JText::_($node->attributes('label'), $control_name.$name;
	
			$return .= '<table class="paramlist admintable" width="100%" cellspacing="1"><tbody>';
		}
	
		
		return $return;
	}
}