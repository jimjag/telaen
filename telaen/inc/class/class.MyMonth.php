<?php

/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

require_once './inc/vendor/iCalcreator.class.php';

/**
 * MyMonth - iCal calendaring support
 * @package Telaen
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 */
class MyMonth
{
    private $_month = 0;
    private $_year = 0;
    private $_mymonth;
    private $_firstday;
    private $_lastday;
    private $_today;
    private $_pmonth;
    private $_pyear;
    private $_nmonth;
    private $_nyear;
    private $_edir;
    private $_vcal;
    private $_perm = 0750;

/**
 * Initialize
 * @param string $udatafolder
 * @param integer $year  year
 * @param integer $month month
 * @return void
 */
    public function __construct($udatafolder, $perm = 0750, $year = 0, $month = 0)
    {
        $this->_perm = $perm;
        $month = intval($month);
        $year = intval($year);
        if (($month <= 0) || ($month >= 13) || ($year <= 2009) || $year >= 2050) {
            $this->_mymonth = getdate();
            $month = $this->_mymonth['mon'];
            $year = $this->_mymonth['year'];
        } else {
            $this->_mymonth = getdate(mktime(0, 0, 0, $month, 1, $year));
        }
        $fom = gmmktime(0, 0, 0, $this->_mymonth['mon'], 1, $this->_mymonth['year']);
        $wd = explode(',', gmstrftime('%m,%Y,%B,%w', $fom));
        $this->_firstday = $wd[3];
        $this->_lastday = gmdate('t', $fom);
        $this->_today = getdate();
        $this->_month = $month;
        $this->_year = $year;
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
        $this->_edir = $udatafolder."/calendar/{$this->_year}/{$this->_month}";
        $this->_vcal = new vcalendar([ 'unique_id' => 'Telaen' ]);
        $this->_vcal->setConfig('directory', $this->_edir);
        $this->_vcal->setConfig('filename',  'events.ics');
        $this->_vcal->parse();
        $this->_vcal->sort();
    }

    /**
     * Return string which has calendar month as HTML table element
     * @return string
     */
    public function monthAsTable()
    {
        $ret = <<<EOT
<table class="month"><tr>
  <th class="week" onclick="replaceCal({$this->_pmonth}, {$this->_pyear}); doDays();"> &laquo; </th>
  <th class="week" onclick="replaceCal({$this->_today["mon"]}, {$this->_today["year"]}); doDays();" colspan="5"> {$this->_mymonth["month"]} - {$this->_mymonth["year"]} </th>
  <th class="week" onclick="replaceCal({$this->_nmonth}, {$this->_nyear}); doDays();"> &raquo; </th>\n</tr>
  <tr class="days"><td>Su</td><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td><td>Sa</td></tr>
EOT;
        if (($this->_today["mon"] == $this->_month) && ($this->_today["year"] == $this->_year)) {
            $today = $this->_today["mday"];
        } else {
            $today = -1;
        }

        $weekday = $this->_firstday;
        $smonth = sprintf("%02s", $this->_month);
        $ret .= "<tr>";
        if ($weekday > 0) {
            $ret .= "<td class='blankday' colspan='{$weekday}'>&nbsp;</td>";
        }
        for ($day = 1; $day <= $this->_lastday; $day++, $weekday++) {
            if ($weekday == 7) {
                $weekday = 0;
                $ret .= "</tr>\n<tr>";
            }
            $dclass = "regday";
            if ($day == $today) {
                $dclass = "today";
            }
            $fullevent = "";
            $event = $this->getEvent($day);
            if ($event) {
                $dclass = "evt";
                if ($day == $today) {
                    $dclass = "tevt";
                }
                $fullevent = "<div class='einfo'>| {$this->_mymonth['month']} {$day}, {$this->_year} |<hr/>";
                foreach ($event as $foo) {
                    $start = $this->_xtime($foo[1]);
                    $stop = $this->_xtime($foo[2]);
                    $fullevent .= "<div id='e_{$foo[0]}'>";
                    $fullevent .= "<div class='etimes'> {$start} ==> {$stop} </div><br/>";
                    $fullevent .= $foo[3]."</div><hr/>";
                }
                $fullevent .= "</div>";
            }
            $sday = sprintf("%02s", $day);
            $ret .= "<td id='d_{$this->_year}{$smonth}{$sday}' class='{$dclass}'> $day $fullevent </td>";
        }
        if ($weekday != 7) {
            $ret .= "<td class='blankday' colspan=".(7-$weekday).">&nbsp;</td>";
        }
        $ret .= "</tr>\n</table>";

        return $ret;
    }

    /**
     * Output calendar month as HTML table element
     * @return void
     */
    public function showMonthAsTable()
    {
        echo $this->monthAsTable();
    }

    /**
     * Return string of calendar month as HTML DIV element
     * @return string
     */
    public function monthAsDiv()
    {
        $end = <<<EOT
</div>
<script type="text/javascript">
//<![CDATA[
	doDays();
//]]>
</script>
EOT;
        $ret = "<script type='text/javascript' src='./inc/js/calendar.js'></script>\n<div id='calendar'>".$this->monthAsTable().$end;

        return $ret;
    }

    /**
     * Output calendar month as HTML DIV element
     * @return void
     */
    public function showMonthAsDiv()
    {
        echo $this->monthAsDiv();
    }

    /**
     * Save calendar events
     * @return void
     */
    public function saveEvents()
    {
        @mkdir($this->_edir, $this->_perm, true);
        $this->_vcal->saveCalendar();
    }

    /**
     * returns [eventuid, dtstart, dtend, desc, starthour, startmin, stophour, stopmin]
     *    The eventuid always contains the date... eg: 20100311_76987 (date + the day uid)
     * @param  string $day Day
     * @return array
     */
    public function getEvent($day)
    {
        $reta = [];
        //$this->_vcal->parse();
        $this->_vcal->sort();
        $events_arr = $this->_vcal->selectComponents($this->_year, $this->_month, $day);
        if (!is_array($events_arr) || count($events_arr) == 0) {
            return $reta;
        }
        foreach ($events_arr as $year => $year_arr) {
            foreach ($year_arr as $month => $month_arr) {
                foreach ($month_arr as $day => $day_arr) {
                    foreach ($day_arr as $event) {
                        $dtstart = $this->_xdtime($event->getProperty('dtstart'));
                        $dtend = $this->_xdtime($event->getProperty('dtend'));
                        $reta[] = [
                            $event->getProperty('uid'), $dtstart, $dtend,
                            base64_decode($event->getProperty('description')),
                            substr($dtstart, 9, 2), substr($dtstart, 11, 2),
                            substr($dtend, 9, 2), substr($dtend, 11, 2),
                        ];
                    }
                }
            }
        }

        return $reta;
    }

    /**
     * Create and set an event
     * @param string $day Day
     * @param string $start Start time
     * @param string $stop Stop time
     * @param string $description Description of event
     * @param string $dayuid Day ID
     * @return boolean
     */
    public function setEvent($day, $start, $stop, $description, $dayuid = "")
    {
        $ymd = sprintf('%4s%02s%02s', $this->_year, $this->_month, $day);
        if ($dayuid) {
            $eventuid = $ymd.'_'.$dayuid;
            @$this->delEvent($eventuid);    // just simpler
        } else {
            /* new event, new id */
            $eventuid = $ymd.uniqid('_').(string)mt_rand();
        }
        $v = new vevent();

        $v->setProperty('dtstart', $ymd.'T'.$start);
        $v->setProperty('dtend', $ymd.'T'.$stop);
        $v->setProperty('uid', $eventuid);
        $v->setProperty('description', base64_encode($description));

        return $this->_vcal->setComponent($v);
    }

    /**
     * Delete event from calendar
     * @param  string] $eventuid Event ID
     * @return boolean
     */
    public function delEvent($eventuid)
    {
        $this->_vcal->deleteComponent($eventuid);
    }

    /**
     * Returns time from DTstamp array (from iCalcreator)
     */
    private function _xdtime($dt)
    {
        $ret = sprintf(
            '%4s%02s%02sT%02s%02s%02s',
            $dt['year'], $dt['month'], $dt['day'],
            $dt['hour'], $dt['min'], $dt['sec']
        );

        return $ret;
    }

    /**
     * Returns time (eg: 07:43 am) from DTstamp string (eg: 20100311T071500)
     */
    private function _xtime($dt)
    {
        $hour = substr($dt, 9, 2);
        $min = substr($dt, 11, 2);
        if ($hour > 12) {
            $hour -= 12;
            $suf = 'pm';
        } else {
            $suf = 'am';
        }

        return (sprintf('%02s:%s %s', $hour, $min, $suf));
    }
}
