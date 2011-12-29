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
 * Renders an author element
 *
 * @package 	Joomla
 * @subpackage	Articles
 * @since		1.5
 */
class JElementDashboard extends JElement
{
	/**
	 * Element name
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'dashboard';

	function fetchElement($name, $value, &$node, $control_name)
	{
		jimport('joomla.html.pane');
        // TODO: allowAllClose should default true in J!1.6, so remove the array when it does.
		$panel = JPane::getInstance('sliders');	
		
		jimport('joomla.language.helper');
        $locale = JLanguageHelper::detectLanguage();
        
        if (function_exists('file_get_contents')){
                
            $instructions = file_get_contents('../modules/mod_ninjamodulehider/dashboard/'.$locale.'/instructions.html');
	        if ( !$instructions ) {
	        	$instructions = file_get_contents('../modules/mod_ninjamodulehider/dashboard/en-GB/instructions.html');
	        }
			
			$changelog = file_get_contents('../modules/mod_ninjamodulehider/dashboard/'.$locale.'/changelog.html');
	        if ( !$changelog ) {
	        	$changelog = file_get_contents('../modules/mod_ninjamodulehider/dashboard/en-GB/changelog.html');
	        }
        } else {
        	$instructions = JText :: _('Please enable file_get_contents');
        	$changelog = JText :: _('Please enable file_get_contents');
        }//if (function_exists('file_get_contents')
		
			
		$return  = '</td></tr></table>';
		$return .= $panel->endPanel();
		$return .= $panel->startPanel(JText :: _('DASHPANELTITLE'), "dashboard");
		$return .= '<style type="text/css"> 
					    #nfouterdiv{ border:1px solid #dddddd;height:580px; }
					    .njtab .inner{height:465px;}
					    .njtab{height:520px;}
					</style>';
		$return .= '		
		<style type="text/css"> 
		#paramsdashboard-lbl     {
			display: none;
		} 
		#hideme {
		display:none;
		}
		
    body{font-family:Helvetica,Arial,sans-serif; }
    #nfouterdiv{background:url(\''.JURI::root().'media/mod_ninjamodulehider/images/dashbg.png\') repeat-x #ffffff 0 0; border:0px solid #dddddd; position:relative; margin:0; }
    .menu{height:55px; width:520px; background:url(\''.JURI::root().'media/mod_ninjamodulehider/images/dashhdrbg.png\') no-repeat 100% 100%; }
    .menu ul{margin:19px 0 0 0; padding:0px; list-style:none; text-align:center; float:right; }
    .menu li{line-height:36px; background:none; margin:0px 0px 0px; padding:0px; cursor:pointer; float:left; height:36px; display:block; }
    .menu li#tablink1{width:125px; }
    .menu li#tablink2{width:111px; }
    .menu li#tablink3{width:77px; }
    .menu li#tablink1.tabactive,.menu li#tablink1:hover{background:url(\''.JURI::root().'media/mod_ninjamodulehider/images/dashtabbg.png\') no-repeat 0 0; }
    .menu li#tablink2.tabactive,.menu li#tablink2:hover{background:url(\''.JURI::root().'media/mod_ninjamodulehider/images/dashtabbg.png\') no-repeat -125px 0; }
    .menu li#tablink3.tabactive,.menu li#tablink3:hover{background:url(\''.JURI::root().'media/mod_ninjamodulehider/images/dashtabbg.png\') no-repeat -236px 0; }
    .tabtxt{padding:0 0 0 0px;height:60px; text-indent:-9999px; display:block; float:left; }
    .njtab{ width:auto; text-align:left; padding:0px 5px 6px 5px; font-size:12px; margin-bottom:5px; clear:right; }
    .njtab .inner{ overflow-y:auto; overflow-x:hidden; width:100%; }
    .njtab h2,.njtab h1{font-weight:bold; text-align:center; }
    .njtab h1{color:#000; margin:10px 0px 15px; padding:0; }
    .njtab strong{font-weight:normal; }
    .njtab dt strong,.njtab h3 strong{font-weight:bold !important; }
    .njtab dt{font-weight:bold !important; padding:5px 0pt 2px; }
.buttons{border:none; padding:3px; }
  </style>
  <!--[if lte IE 6]>     
    <style>
  	 .njtab h1 {margin:0px 0px 15px 0px !important;}
     .njtab {padding:0px 0px 6px !important;}           
    </style>
	<![endif]--> 
		
		<script type="text/javascript" language="JavaScript" src="'.JURI::root().'/media/mod_ninjamodulehider/js/ninja.js"></script>
		
		<div id="nfouterdiv">
<div class="menu">
  <ul>
    <li onclick="easytabs(\'1\', \'1\');" onfocus="easytabs(\'1\', \'1\');" onmouseover="return false;"  title="" id="tablink1"><span id="info" class="tabtxt">General Info</span></li>
    <li onclick="easytabs(\'1\', \'2\');" onFocus="easytabs(\'1\', \'2\');" onmouseover="return false;"  title="" id="tablink2"><span id="inst" class="tabtxt">Instructions</span></li>
    <li onclick="easytabs(\'1\', \'3\');" onFocus="easytabs(\'1\', \'3\');" onmouseover="return false;"  title="" id="tablink3"><span id="change" class="tabtxt">Changelog & Version Info</span></li>
  </ul>
</div>
<div id="tabcontent1" class="njtab">

    <h1>'.JText::_('INSTRUCTIONS').'</h1>  
    <div class="inner">   
    '.$instructions.'
</div></div>

<div id="tabcontent2" class="njtab">
<h1>'.JText::_('CHANGELOG').'</h1> 
<div class="inner">
'.$changelog.'
</div></div>
<div id="tabcontent3" class="njtab">
    <h1>'.JText::_('EXTNAME').'</h1>
    <div class="inner">
    <h2>'.JText::_('EXTSUBTITLE').'</h2>
    <center><img src="'.JURI::root().'media/mod_ninjamodulehider/images/logo.png" alt="NinjaSlide"></center>
    <p><b>'.JText::_('EXTCREATEDBY').'</b> '.JText::_('EXTCREATEDBYTXT').'</p>
    <p><b>'.JText::_('EXTPHPLIC').'</b>  <a href="http://creativecommons.org/licenses/GPL/2.0/"> GNU GPL</a></p>
    <p><b>'.JText::_('EXTCSSIMGCOP').'</b> '.JText::_('EXTCSSIMGCOPTXT').'</p>
    <p><b>'.JText::_('EXTSUP').'</b> '.JText::_('EXTSUPTXT').'</p>
    <p><b>'.JText::_('EXTRATE').'</b> '.JText::_('EXTRATETXT').'</p>
</div></div></div><br />
<center>
<a href="http://www.ninjaforge.com" target="_self"><img  class="buttons" src="'.JURI::root().'media/mod_ninjamodulehider/images/ninjaforge.png" alt="Visit NinjaForge" title="Visit Ninjaforge"/></a>
<a href="http://www.mozilla-europe.org/en/firefox/" target="_self"><img class="buttons" src="'.JURI::root().'media/mod_ninjamodulehider/images/firefox3.png" alt="Get Firefox for a better internet experience" title="Get Firefox for a better internet experience"/></a>
<a href="http://getfirebug.com/" target="_self"><img class="buttons" src="'.JURI::root().'media/mod_ninjamodulehider/images/firebug.png" alt="Ninjas use and recommend Firebug" title="Ninjas use and recommend Firebug"/></a>
<a href="http://validator.w3.org/check?uri=referer" target="_self"><img  class="buttons" src="'.JURI::root().'media/mod_ninjamodulehider/images/validation_xhtml.png" alt="Valid XHTML Transitional" title="Valid XHTML Transitional"/></a>
<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_self"><img  class="buttons" src="'.JURI::root().'media/mod_ninjamodulehider/images/validation_css.png" alt="Valid CSS" title="Valid CSS"/></a>
<a href="http://creativecommons.org/licenses/GPL/2.0/"><img  class="buttons" alt="CC-GNU GPL" src="'.JURI::root().'media/mod_ninjamodulehider/images/gnugpl.png" alt="GNU GPL Icon" title="All PHP code in this extension is licensed GNU GPL" /></a>
<br /><br /><br />
</center>
		
		';
		if(!$this->_parent->get('dashboardStyle')) {	
			$return .= '<style type="text/css"> 

		
  
    #nfouterdiv{ border:1px solid #dddddd; }
  </style>';
  
  
			$return .= $panel->startPanel(JText :: _('This is a workaround.'), "hideme");
		}
		
		return $return;
	}
}