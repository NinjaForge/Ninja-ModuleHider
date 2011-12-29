<?php
/*
 * Ninja Helper Functions Class
 * 
 * This is just some utility functions which we use frequently.
 */
 
 
// Ensure this file is being included by a parent file. 
defined ( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class modNinjaModulehiderHelper {

/**** 
* Render a particular module inside another module (or component etc.) 
****/
	function renderModule( $id, $style='xhtml' ) {
		
		$user = JFactory::getUser();
        $db   = JFactory::getDBO();
        $app  = JFactory::getApplication(); 
        
        $aid    = $user->get('aid', 0);

        $query = 'SELECT id, title, module, position, content, showtitle, control, params'
            . ' FROM #__modules AS m'
            . ' WHERE m.access <= '. (int)$aid
            . ' AND m.client_id = '. (int)$app->getClientId()
            . ' AND m.id = '. (int)$id;
        
        $db->setQuery( $query );
        
        if (null === ($newModule = $db->loadObject())) {
            JError::raiseWarning( 'SOME_ERROR_CODE', JText::_( 'Error Loading Modules' ) . $db->getErrorMsg());
            return false;
        }
        
        //determine if this is a custom module
        $file                    = $newModule->module;
        $custom                 = substr( $file, 0, 4 ) == 'mod_' ?  0 : 1;
        $newModule->user      = $custom;
        // CHECK: custom module name is given by the title field, otherwise it's just 'om' ??
        $newModule->name        = $custom ? $newModule->title : substr( $file, 4 );
        $newModule->style        = null;
        $newModule->position    = strtolower($newModule->position);	
		
	  	//set the module chrome   
		$attribs['style'] = $style;
				
		//needed for the render function below
		jimport( 'joomla.application.module.helper' );
		    		        	    
		return JModuleHelper::renderModule( $newModule, $attribs );	  	
    }//renderModule function 
    
    
                               	

} //class declaration