{include file=$popupHeaderTemplate pageTitle=$smLabel.evt_title}

<body>
<div id="popup">
{if $smShowEventForm == "YES"}
{section name=i loop=$smEvent}
<form name="form{$smarty.section.i.index}" action="event.php" method="post">
  <table cellspacing="2" cellpadding="0" border="0" align="center" bgcolor="White" width="100%">

      <th colspan="2" align="center"> {$smEventHeader} </th>
    <tr>
      <td>{$smLabel.evt_start}</td>
      <td><select name="starthour">

					{html_options values=$hours output=$dhours selected=$smEvent[i][4]}

        </select>
        <select name="startmin">

					{html_options values=$mins output=$mins selected=$smEvent[i][5]}

        </select></td>
    </tr>
    <tr>
      <td>{$smLabel.evt_stop}</td>
      <td><select name="stophour">

					{html_options values=$hours output=$dhours selected=$smEvent[i][6]}

        </select>
        <select name="stopmin">

					{html_options values=$mins output=$mins selected=$smEvent[i][7]}

        </select></td>
    </tr>
    <tr>
      <td class="default" colspan="2" align="center"><textarea cols="50" rows="15" id="etext_{$smarty.section.i.index}" name="etext_{$smarty.section.i.index}">{$smEvent[i][3]|escape:"html"}</textarea></td>
    <tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td align="left"><input type="submit" name="evsave" value="&nbsp;{$smLabel.evt_save}&nbsp;" /></td>
      <td align="right"><input type="submit" name="evdelete" value="&nbsp;{$smLabel.evt_delete}&nbsp;" /></td>
    </tr>
  </table>
  <input type="hidden" name="edate" value="e_{$smEvent[i][0]}">
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
