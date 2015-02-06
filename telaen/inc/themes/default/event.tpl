{include file=$popupHeaderTemplate pageTitle=$umLabel.evt_title}

<body>
<div id="popup">
{if $umShowEventForm == "YES"}
{section name=i loop=$umEvent}
<form name="form{$smarty.section.i.index}" action="event.php" method="post">
  <table cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="White" width="100%">

      <th colspan="2" align="center"> {$umEventHeader} </th>
    <tr>
      <td>{$umLabel.evt_start}</td>
      <td><select name="starthour">

					{html_options values=$hours output=$dhours selected=$umEvent[i][4]}

        </select>
        <select name="startmin">

					{html_options values=$mins output=$mins selected=$umEvent[i][5]}

        </select></td>
    </tr>
    <tr>
      <td>{$umLabel.evt_stop}</td>
      <td><select name="stophour">

					{html_options values=$hours output=$dhours selected=$umEvent[i][6]}

        </select>
        <select name="stopmin">

					{html_options values=$mins output=$mins selected=$umEvent[i][7]}

        </select></td>
    </tr>
    <tr>
      <td class="default" colspan="2" align="center"><textarea cols="50" rows="15" id="etext_{$smarty.section.i.index}" name="etext_{$smarty.section.i.index}">{$umEvent[i][3]|escape:"html"}</textarea></td>
    <tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="left"><input type="submit" name="evsave" value="&nbsp;{$umLabel.evt_save}&nbsp;" /></td>
      <td align="right"><input type="submit" name="evdelete" value="&nbsp;{$umLabel.evt_delete}&nbsp;" /></td>
    </tr>
  </table>
  <input type="hidden" name="edate" value="e_{$umEvent[i][0]}">
  <input type="hidden" name="eventn" value="{$smarty.section.i.index}">
</form>
<hr align="center" width="75%">
{/section}
{else}
<script type="text/javascript">
//<![CDATA[
	refreshParent();
//]]>
</script>
{/if}

{include file=$footerTemplate}
