{include file=$headerTemplate pageTitle=$smLabel.blk_title}
<form name="form1" action="block_address.php" method="post">
  <input type="hidden" name="ix" value="{$smIx}" />
  <input type="hidden" name="folder" value="{$smFolder|escape:"html"}" />
  <table width="500" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><img src="images/telaen_logo.jpg" width="310" height="73" alt="Telaen Webmail"></td>
    </tr>
    <tr>
      <td class="default"  width="100%" align="center"><b>{$smLabel.blk_information}</b><br />
        <br /></td>
    </tr>
    {if $smAvailableAddresses gt 0 }
    <tr>
      <td class="headers"><b>{$smLabel.blk_email}</b></td>
    </tr>
    {section name=i loop=$smAddressList}
    <tr>
      <td class="default" valign="top"><input type="checkbox" name="fFilter[]" checked value="{$smAddressList[i].index}">
        {$smAddressList[i].mail}</td>
    </tr>
    {/section}
    <tr>
      <td class="cent"><br />
        <br />
        <input type="submit" name="submit" class="button" value="{$smLabel.blk_save}"></td>
    </tr>
    {else}
    <tr>
      <td class="cent">{$smLabel.blk_no_address}</td>
    </tr>
    <tr>
      <td class="cent"><br />
        <br />
        <a href="javascript:self.close()">{$smLabel.blk_close}</a></td>
    </tr>
    {/if}
  </table>
</form>
{include file=$footerTemplate} 