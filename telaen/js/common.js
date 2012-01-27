// common navigation js
function goinbox()   { window.location = 'messages.php?folder=inbox'; }
function addresses() { window.location = 'addressbook.php'; }
function prefs()     { window.location = 'preferences.php'; }
function goend()     { window.location = 'logout.php'; }

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

/**
 * clock funcs
 */
var timerID = null;
var timerRunning = false;

function stopclock() {
if(timerRunning)
	clearTimeout(timerID);
	timerRunning = false;
}
function showtime() {
	var now = new Date();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds();
	var timeValue = "" + ((hours >12) ? hours -12 :hours)
	if (timeValue == "0"){timeValue = 12;}
	timeValue += ((minutes < 10) ? ":0" : ":") + minutes
	timeValue += ((seconds < 10) ? ":0" : ":") + seconds
	timeValue += (hours >= 12) ? " PM" : " AM"
	document.getElementById('clock').innerHTML = timeValue;

	// catch midnight rollover and refresh date
	if(timeValue == '0:00:01 AM'){makeDate();}

	timerID = setTimeout("showtime()",1000);
	timerRunning = true;
}
function makeDate() {
	var mydate=new Date();
	var year=mydate.getYear();
	if(year < 1000){year+=1900;}
	var day=mydate.getDay();
	var month=mydate.getMonth();
	var daym=mydate.getDate();
	if (daym<10){daym="0"+daym;}
	var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
	var datexx = dayarray[day]+", "+montharray[month]+" "+daym+", "+year;
	document.getElementById('dfield').innerHTML = datexx;
}
function startclock() {
	stopclock();
	showtime();
	makeDate();
}

