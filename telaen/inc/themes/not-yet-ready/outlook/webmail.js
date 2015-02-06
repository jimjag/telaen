<!--
	function setVisible(obj, bool){
		if(typeof obj == "string")
			obj = document.getElementById(obj);
		if(bool == false){
			if(obj.style.visibility != 'hidden');
				obj.style.visibility = 'hidden';
		} else {
			if(obj.style.visibility != 'visible');
			obj.style.visibility = 'visible';
		}
	}

	function mOvr(src,clrOver) {
		if (!src.contains(event.fromElement)) {
			src.style.cursor = 'hand';
			src.bgColor = clrOver;
		}
	}
	function mOut(src,clrIn) {
		if (!src.contains(event.toElement)) {
			src.style.cursor = 'default';
			src.bgColor = clrIn;
		}
	}
	function mClk(src) {
		if(event.srcElement.tagName=='TD'){
			src.children.tags('A')[0].click();
		}
	}

function switchPrefsTab(tab) {
	// hide all
	document.getElementById('info').className='tab_hidden';
	document.getElementById('trash').className='tab_hidden';
	document.getElementById('messages').className='tab_hidden';
	document.getElementById('filters').className='tab_hidden';
	document.getElementById('tab_info').className='tab_info_hidden';
	document.getElementById('tab_trash').className='tab_info_hidden';
	document.getElementById('tab_messages').className='tab_info_hidden';
	document.getElementById('tab_filters').className='tab_info_hidden';
	// show needed
	document.getElementById('tab_'+tab).className='tab_info_visible';
	document.getElementById(tab).className='tab_visible';
}
// -->	
