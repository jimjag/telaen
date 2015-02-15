{include file=$headerTemplate pageTitle=$smLabel.adr_title}

{include file=$menuTemplate refresh="false"}
<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" bgcolor="#DDE3EB">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="headerright" width="40%">{$smLabel.adr_name} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrName|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_email} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrEmail|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_street} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrStreet|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_city} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrCity|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_state} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrState|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_work} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrWork|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_phone} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrPhone|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_cell} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrCell|escape:"html"}</td>
        </tr>
        <tr>
          <td class="headerright">{$smLabel.adr_note} &nbsp;</td>
          <td class="default">&nbsp;{$smAddrNote|escape:"html"}</td>
        </tr>
        <tr>
          <td class="usage" colspan="2"><center>
              <table class="buttonTable" cellspacing="0" >
                <tr>
                  <td valign="middle" class="buttonLeft">&nbsp;</td>
                  <td valign="middle" class="buttonMiddle"><input class="button" type="button" name="button" onclick="javascript:location = '{$smGoBack}'" value="{$smLabel.adr_back}" /></td>
                  <td valign="middle" class="buttonRight">&nbsp;</td>
                </tr>
              </table>
            </center></td>
        </tr>
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 