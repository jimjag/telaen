function replaceCal(month, year) {
	new Ajax.Updater("calendar", "ajax.php", {
		method : "post",
		parameters : {action: "replaceCal", cal_month: month, cal_year: year },
		onComplete: function(){ doDays(); }
    });
}


function doDays() {
	var grrr = navigator.userAgent.indexOf("MSIE")>-1;
	var tds = document.getElementById("calendar").getElementsByTagName("td");
	for (var i=0; i<tds.length; i++) {
		if (tds[i].className=="regday" || tds[i].className=="today" || tds[i].className=="evt" || tds[i].className=="tevt") {
			tds[i].onclick = function() {
				var url = "./event.php?edate=" + this.id;
				window.open(url, "Event", "width=550, height=350, scrollbars=1, resizable=1");
				return false;
			}
		}
	}
	var einfo = document.getElementById("calendar").getElementsByTagName("div");
	for (var i=0; i<einfo.length; i++) {
			if (einfo[i].className=="einfo") {
				var elem = document.getElementById(einfo[i].id);
				if (grrr && elem!=null) {
					tds[i].onmouseover = function() {
						document.getElementById(this.id).style.display = "block";
					}
					tds[i].onmouseout = function() {
						document.getElementById(this.id).style.display = "none";
					}
					elem.onmouseover = function() {
						document.getElementById(this.id).style.display = "block";
					}
					elem.onmouseout = function() {
						document.getElementById(this.id).style.display = "none";
					}
				}
			}

		}
	}
}

function refreshParent() {
	window.opener.location.reload();

	if (window.opener.eventWindow) {
		window.opener.eventWindow.close()
	}
  window.close();
}
