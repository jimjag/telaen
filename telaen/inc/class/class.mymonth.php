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
	var $_pmonth;
	var $_pyear;
	var $_nmonth;
	var $_nyear;

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
		$this->_pyear = $this->_nyear = $this->_year;
		$this->_pmonth = $this->_month - 1;
		if ($this->_pmonth <= 0) {
			$this->_pmonth = 12;
			$this->_pyear--;
		}
		$this->_nmonth = $this->_month + 1;
		if ($this->_nmonth >= 13) {
			$this->_nmonth = 1;
			$this->_nyear++;
		}
	}

	function monthAsTable() {

		$ret = <<<EOT
<table class="month"><tr>
  <th class="week" onclick="replaceCal({$this->_pmonth}, {$this->_pyear});"> &laquo; </th>
  <th class="week" colspan="5"> {$this->_mymonth["month"]} - {$this->_mymonth["year"]} </th>
  <th class="week" onclick="replaceCal({$this->_nmonth}, {$this->_nyear});"> &raquo; </th>\n</tr>
  <tr class="days"><td>Su</td><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td><td>Sa</td></tr>
EOT;
		if (($this->_today["mon"] == $this->_month) && ($this->_today["year"] == $this->_year))
			$today = $this->_today["mday"];
		else
			$today = -1;

		$weekday = $this->_firstday;
		$ret .= "<tr>";
		if($weekday > 0) $ret .= "<td class=\"blankday\" colspan=\"{$weekday}\">&nbsp;</td>";
		for($day=1; $day<=$this->_lastday; $day++,$weekday++){
			if($weekday == 7) {
				$weekday = 0;
				$ret .= "</tr>\n<tr>";
			}
			if ($day == $today) {
				$ret .= "<td class=\"today\"> $day </td>";
			} else {
				$ret .= "<td class=\"regday\"> $day </td>";
			}
		}
		if($weekday != 7) $ret .= "<td class=\"blankday\" colspan=".(7-$weekday).">&nbsp;</td>";
		$ret .= "</tr>\n</table>";
		return $ret;
	}

	function showMonthAsTable() {
		echo $this->monthAsTable();
	}

	function monthAsDiv() {
		$end = <<<EOT
</div>
<script type="text/javascript">
//<![CDATA[
	doDays();
//]]>
</script>
EOT;
		$ret = "<script type=\"text/javascript\" src=\"./js/calendar.js\"></script>\n<div id=\"calendar\">" . $this->monthAsTable() . $end;
		return $ret;
	}

	function showMonthAsDiv() {
		echo $this->monthAsDiv();
	}

}
?>