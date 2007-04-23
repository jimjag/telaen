// common navigation js
function goinbox() {
	location = 'messages.php?folder=inbox';
}
function addresses() {
	location = 'addressbook.php';
}
function prefs() {
	location = 'preferences.php';
}
function goend() {
        location = 'logout.php';
}

/**
 * This set an action (if needed) and submit the form
 *
 * formid  => the form id 
 * task => action to do (sets the 'action' field on form), use default if none specified
 */
function submitForm(formid, task) {
        // get the form
        var f = $(formid);
        // set the action
        if(task && task != '') {
                f.action.value = task
        }
        f.submit();
}


/**
 * This function select a checkbox from a list, 
 * set an action (if needed) and submit the form
 *
 * formid  => the form id 
 * id => checkbox number, the cb id must be 'cb + n'
 * task => action to do (sets the 'action' field on form), use default if none specified
 */
function selectAndSubmit(formid, id, task) {
	// get the form
	var f = $(formid);
	// set the checkbox
	cb = eval('f.cb' + id);
        if(cb) {
                cb.checked = true;
        }
        // set the action
	if(task && task != '') {
		f.action.value = task
	}		
	f.submit();	
}

/**
 * This function select/deselect checkboxes from a list.
 * The selector checkbox must have id 'toggle' and checboxes 'cb + n'
 * 
 * formid  => the form id
 * n => numeber of elements to select
 * 
 */
function selectAll(formid, n) {
	// get the form
	var f = $(formid);
	// get toggle status
	var ck = f.toggle.checked;
	// set the cbs
	for(i=0; i<n; i++) {
		cb = eval('f.cb' + i);	
		if(cb) {
			cb.checked = ck;
		}
	}
}

