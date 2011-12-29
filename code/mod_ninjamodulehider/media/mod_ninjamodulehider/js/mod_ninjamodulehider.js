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
* 1.1 July 19, 07 : 
*       Added a lot of comments to the source (pro version) 
*       Revised the JS to be cleaner and stripped most of it out into a seperate file
*       Included the initial_hidden class to hide the modulehider contents while the JS is loading.       
* 
* 1.0 May 3, 07 : 
*       Initial Version
* 
*/

//The array of the mdlhdr_innr divs. This will be populated with a slider object for 
//each module hider on the page.
var mhInnerArray = new Array();

//window.addEvent is used to ensure that other events can be attached to the window also
window.addEvent('domready', function() {

        //cycle through the containers
        $$('div.mdlhdr_cont').each(function(theDiv, i){
                
            //grab the mdlhdr_innr div for this modulehider
            var innrDiv = theDiv.getElement('.mdlhdr_innr');
            
            //lets store the id of this div, and a slider object of the inner div 
            //in the array we created above as a nested array
            mhInnerArray[i] = new Array(theDiv.id, 
                                        //The id above allows me to find the slider object below in the array.
                                        new Fx.Slide(innrDiv.id, {duration: 1000})); 
            
            //retrieve our cookie
            var tempCookie = Cookie.get(theDiv.id);
            
            //get the handle so we can set the message on it.
            var handleDiv = theDiv.getElement('.mdlhdr_hdl');
			
			//this ugly messing around is to accomodate multiple instances on the same page
			eval ('var useCookie = mdlhdr_use_cookie'+theDiv.id.substring(7)+';');
			eval ('var initialState = mdlhdr_initial_state'+theDiv.id.substring(7)+';'); 
			            
            //is there a cookie set, and does it equal closed
            //if so keep the modulehider closed
            if ((tempCookie == 'closed' && useCookie == 1)|| (useCookie == 0 && initialState == 0) || (tempCookie == false &&  initialState == 0)){
                
                //hide the mdlhdr_innr div 
                mhInnerArray[i][1].hide();
                //Set the message to the closed message
				eval ('handleDiv.setHTML(mdlhdr_cl_message'+theDiv.id.substring(7)+');');
				
				
                //Remove the initial_hide class
                theDiv.removeClass('initial_hide');
              
              //if the cookie isn't declared, or it is and is set to open
              //then open the modulehider.
             }else{
             
             	
             	//first hide it so we can remove the invisibility and then open 
                //it cleanly with effects.  
                mhInnerArray[i][1].hide();
                //Set it to opacity 0 so we can fade it in while it is opening.
                innrDiv.setOpacity(0);
                //Now that it is closed and opacity 0 we can remove the 
                //initial_hide class without the modulehider displaying
                theDiv.removeClass('initial_hide');
                //Now begin a 1000 millisecond fade in
                innrDiv.effect('opacity',{
                              	duration: 1000
                              }).start(0,1);
                //being the slide in which was set to 1000 milliseconds
                //It will now open and fade in simultaneously
                mhInnerArray[i][1].slideIn();
                //Set the handle message to the open message
				eval ('handleDiv.setHTML(mdlhdr_op_message'+theDiv.id.substring(7)+');');
             }
             
             handleDiv.addEvent('click',function(e) {
                                  e = new Event(e).stop();
                                  tggl_mdlhdr(i);
                                });
        });//$$('div.mdlhdr_cont').each
});//window.addEvent  
  

function tggl_mdlhdr(i){

      //retrieve the cookie for the activated div
      var cookieName = mhInnerArray[i][0];
      var tempCookie = Cookie.get(cookieName);
      
      //Find our modulehider div that was activated
      var theDiv = $(mhInnerArray[i][0]);
      
      //get the handle so we can set the message on it.
      var handleDiv = theDiv.getElement('.mdlhdr_hdl');
      
      //grab the mdlhdr_innr div for this modulehider
      //This is so we can fade it in and out when sliding it in and out
      var innrDiv = theDiv.getElement('.mdlhdr_innr');    
      
      //is there a cookie set, and does it equal closed
      //if so keep the modulehider closed
      if (tempCookie == 'closed'){
        
        //Now begin a 1000 millisecond fade in to coincide with the slide in
        innrDiv.effect('opacity',{
                      	duration: 1000
                      }).start(0,1);
        //being the slide in which was set to 1000 milliseconds
        //It will now open and fade in simultaneously
        mhInnerArray[i][1].slideIn();
        //Set the handle message to the open message
		eval ('handleDiv.setHTML(mdlhdr_op_message'+mhInnerArray[i][0].substring(7)+');');
        //Set the cookie        
        Cookie.set(cookieName, 'open', {duration: 3600});
        
      }else{
        //Now begin a 1000 millisecond fade in to coincide with the slide in
        innrDiv.effect('opacity',{
                      	duration: 1000
                      }).start(1,0);
        //being the slide in which was set to 1000 milliseconds
        //It will now open and fade in simultaneously
        mhInnerArray[i][1].slideOut();
        //Set the cookie        
        Cookie.set(cookieName, 'closed', {duration: 3600});
        //Set the message to the closed message
		eval ('handleDiv.setHTML(mdlhdr_cl_message'+mhInnerArray[i][0].substring(7)+');');
      }
};
      
    
      
