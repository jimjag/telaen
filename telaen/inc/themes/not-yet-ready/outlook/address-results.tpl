<html>
{$umJS}
{if $umOpt eq 1}
<BODY ONLOAD="javascript:alert('{$umLabel.addr_saved}');parent.location='addressbook.php';">
{elseif $umOpt eq 2}
	{if $smarty.request.page_ref=="readmsg"}
<BODY ONLOAD="javascript:alert('{$umLabel.addr_added}');">
{else}
<BODY ONLOAD="javascript:alert('{$umLabel.addr_added}');parent.location='addressbook.php';">
{/if}
{elseif $umOpt eq 3}
<BODY ONLOAD="javascript:alert('{$umLabel.addr_deleted}');parent.location='addressbook.php';">
{/if}
</IF>
</BODY>
</html>
