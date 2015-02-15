{include file=$headerTemplate pageTitle=$smLabel.adr_title}

{include file=$menuTemplate refresh="false"}
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#DDE3EB" width="100%">
  <tr>
    <td bgcolor="#DDE3EB"><form name="form1" method="post" action="addressbook.php">
        <input type="hidden" name="id" value="{$smAddrID}" />
        <input type="hidden" name="opt" value="{$smOpt}"/>
        <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="headerright" width="40%">{$smLabel.adr_name} &nbsp;</td>
            <td><input size="40" type="text" name="name" value="{$smAddrName|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_email} &nbsp;</td>
            <td><input size="40" type="text" name="email" value="{$smAddrEmail|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_street} &nbsp;</td>
            <td><input size="40" type="text" name="street" value="{$smAddrStreet|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_city} &nbsp;</td>
            <td><input size="40" type="text" name="city" value="{$smAddrCity|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_state} &nbsp;</td>
            <td><input size="3" type="text" name="state" value="{$smAddrState|escape:"html"}" class="textbox" maxlength="2" /></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_work} &nbsp;</td>
            <td><input size="40" type="text" name="work" value="{$smAddrWork|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_phone} &nbsp;</td>
            <td><input size="40" type="text" name="work" value="{$smAddrPhone|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_cell} &nbsp;</td>
            <td><input size="40" type="text" name="work" value="{$smAddrCell|escape:"html"}" class="textbox" /></td>
          </tr>
          <tr>
            <td class="headerright">{$smLabel.adr_note} &nbsp;</td>
            <td><textarea cols="40" rows="5" type="text" name="work" value="{$smAddrNote|escape:"html"}" class="textbox">{$smAddrNote|escape:"html"</textarea></td>
          </tr>
          <tr>
            <td colspan="2" class="usage"><center>
                <table>
                  <tr>
                    <td><table class="buttonTable" cellspacing="0" >
                        <tr>
                          <td valign="middle" class="buttonLeft">&nbsp;</td>
                          <td valign="middle" class="buttonMiddle"><input class="button" type="submit" name="submit" onclick="javascript:document.form1.submit()" value="{$smLabel.adr_save}" /></td>
                          <td valign="middle" class="buttonRight">&nbsp;</td>
                        </tr>
                      </table></td>
                    <td><table class="buttonTable" cellspacing="0" >
                        <tr>
                          <td valign="middle" class="buttonLeft">&nbsp;</td>
                          <td valign="middle" class="buttonMiddle"><input class="button" type="button" name="button" onclick="javascript:location = '{$smGoBack}'" value="{$smLabel.adr_back}" /></td>
                          <td valign="middle" class="buttonRight">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
              </center></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
{include file=$footerTemplate} 