{include file=$headerTemplate pageTitle=#newmsg_title# }

{include file=$menuTemplate refresh="false"}
<table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#DDE3EB" width="100%">
  <tr>
    <td valign="middle" bgcolor="white"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        {if $smMailSent}
        <tr>
          <td class="cent"> {$smLabel.result_success}<br />
            <br />
            <center>
              <table class="buttonTable" cellspacing="0" >
                <tr>
                  <td valign="middle" class="buttonLeft">&nbsp;</td>
                  <td valign="middle" class="buttonMiddle"><a class="login" href="messages.php" >{$smLabel.nav_continue}</a></td>
                  <td valign="middle" class="buttonRight">&nbsp;</td>
                </tr>
              </table>
            </center></td>
        </tr>
        {else}
        <tr>
          <td class="cent"> {$smLabel.result_error}<br />
            <br />
            <font color="red">{$smErrorMessage}</font><br />
            <br />
            <center>
              <table class="buttonTable" cellspacing="0" >
                <tr>
                  <td valign="middle" class="buttonLeft">&nbsp;</td>
                  <td valign="middle" class="buttonMiddle"><a class="login" href="#" onclick="javascript:history.go(-1)">{$smLabel.nav_back}</a></td>
                  <td valign="middle" class="buttonRight">&nbsp;</td>
                </tr>
              </table>
            </center></td>
        </tr>
        {/if}
      </table></td>
  </tr>
</table>
{include file=$footerTemplate} 