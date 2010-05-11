function replaceCal(month, year) {
  new Ajax.Updater("calendar", "ajax.php", {
    method : "post",
    parameters : {action: "replaceCal", cal_month: month, cal_year: year }
    });
}

