{include file=$headerTemplate pageTitle=$smLabel.adr_title}
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="white">
  <tr>
    <td valign=top width="20%"> {include file=$menuTemplate refresh="false"}
      {include file=$calendarTemplate}
      {include file=$newsTemplate} </td>
    <td bgcolor="white" valign="top"><form name="form1" method="post" action="addressbook.php">
        <input type="hidden" name="id" value="{$smAddrID}">
        <input type="hidden" name="opt" value="{$smOpt}">
        <table width="500" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td class="headerright" size="20%">{$smLabel.adr_name} &nbsp;</td>
            <td><input size="40" type=text name="name" value="{$smAddrName|escape:"html"}" class="textbox"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_email} &nbsp;</td>
            <td><input size="40" type=text name="email" value="{$smAddrEmail|escape:"html"}" class="textbox"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_street} &nbsp;</td>
            <td><input size="40" type=text name="street" value="{$smAddrStreet|escape:"html"}" class="textbox"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_city} &nbsp;</td>
            <td><input size="40" type=text name="city" value="{$smAddrCity|escape:"html"}" class="textbox"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_state} &nbsp;</td>
            <td><input size="3" type=text name="state" value="{$smAddrState|escape:"html"}" class="textbox" maxlength=2></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_work} &nbsp;</td>
            <td><input size="40" type=text name="work" value="{$smAddrWork|escape:"html"}" class="textbox"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_phone} &nbsp;</td>
            <td><input size="40" type=text name="phone" value="{$smAddrPhone|escape:"html"}" class="textbox"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_cell} &nbsp;</td>
            <td><input size="40" type=text name="cell" value="{$smAddrCell|escape:"html"}" class="textbox"></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_note} &nbsp;</td>
            <td><textarea cols="40"  name="note" rows="5" class="textbox">{$smAddrWork|escape:"html"}</textarea></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type=submit value="{$smLabel.adr_save}" class=button>
              &nbsp;
              <input type=button value="{$smLabel.adr_back}" class=button onClick="location = '{$smGoBack}'"></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
{include file=$footerTemplate} 