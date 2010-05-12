function replaceCal(month, year) {
	new Ajax.Updater("calendar", "ajax.php", {
		method : "post",
		parameters : {action: "replaceCal", cal_month: month, cal_year: year }
    });
}


function doDays() {
	var tds = document.getElementById("calendar").getElementsByTagName("td");
	for (var i=0; i<tds.length; i++) {
		if (tds[i].className=="regday" || tds[i].className=="today"|| tds[i].className=="event" || tds[i].className=="event2") {
			tds[i].onclick = function() {
				var url = "./event.php?edate=" + this.id;
				window.open(url, "Event", "width=550, height=350, scrollbars=1, resizable=1");
				return false;
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
