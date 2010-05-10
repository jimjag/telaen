<?php

/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.com/

*************************************************************************/

class MyMonth {
	var $_month = 0;
	var $_year = 0;
	var $_mymonth;
	var $_firstday;
	var $_lastday;
	var $_today;

	function MyMonth($month=0, $year=0) {
		if (($month <= 0) || ($month >= 13) || ($year <= 0) || $year >= 2050){
		   $this->_mymonth	= getdate();
		   $month = $this->_mymonth['mon'];
		   $year = $this->_mymonth['year'];
		} else {
		   $this->_mymonth	= getdate(mktime(0,0,0,$month,1,$year));
		}
		$fom = gmmktime(0,0,0,$this->_mymonth['mon'],1,$this->_mymonth['year']);
		$wd = explode(',',gmstrftime('%m,%Y,%B,%w',$fom));
		$this->_firstday = $wd[3];
		$this->_lastday = gmdate('t',$fom);
		$this->_today = getdate();
		$this->_month = intval($month);
		$this->_year = intval($year);
	}
	
	function monthAsTable() {

        $ret = "<table class='month'>";
		$ret .= "  <tr><th colspan='7'> {$this->_mymonth['month']} - {$this->_mymonth['year']} </th></tr>";
		$ret .= "  <tr class='days'><td>Su</td><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td><td>Sa</td></tr>";
		
		if (($this->_today['mon'] == $this->_month) && ($this->_today['year'] == $this->_year))
			$today = $this->_today['mday'];
		else
			$today = -1;
	
		$weekday = $this->_firstday;
		$ret .= "<tr>";
		if($weekday > 0) $ret .= "<td class='regday' colspan='{$weekday}'>&nbsp;</td>";
		for($day=1; $day<=$this->_lastday; $day++,$weekday++){
			if($weekday == 7) {
				$weekday = 0;
				$ret .= "</tr>\n<tr>";
			}
			if ($day == $today) {
				$ret .= "<td class='today'> $day </td>";
			} else {
				$ret .= "<td class='regday'> $day </td>";
			}
		}
		if($weekday != 7) $ret .= "<td class='regday' colspan=".(7-$weekday).">&nbsp;</td>";
		$ret .= "</tr>";
		$ret .= "</table>";
	}
	return $ret;
	
	function showMonth() {
		echo $this->monthAsTable;
	}
}
?>
