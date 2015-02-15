<html>
{$smJS}
{if $smOpt eq 1}
<BODY ONLOAD="javascript:alert('{$smLabel.addr_saved}');parent.location='addressbook.php';">
{elseif $smOpt eq 2}
	{if $smarty.request.page_ref=="readmsg"}
<BODY ONLOAD="javascript:alert('{$smLabel.addr_added}');">
{else}
<BODY ONLOAD="javascript:alert('{$smLabel.addr_added}');parent.location='addressbook.php';">
{/if}
{elseif $smOpt eq 3}
<BODY ONLOAD="javascript:alert('{$smLabel.addr_deleted}');parent.location='addressbook.php';">
{/if}
</IF>
</BODY>
</html>
