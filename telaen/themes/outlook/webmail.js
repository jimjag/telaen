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

// -->	
