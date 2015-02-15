<!-- menu template -->

<table cellspacing="1" cellpadding="3" width="100%" border="0" bgcolor="White">
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="goinbox();"><a class="menu" href="javascript:goinbox()">{$smLabel.messages_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="newmsg();"><a class="menu" href="javascript:newmsg()">{$smLabel.compose_mnu}</a></td>
  </tr>
  {if $refresh neq "false"}
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="refreshlist();"><a class="menu" href="javascript:refreshlist()">{$smLabel.refresh_mnu}</a></td>
  </tr>
  {/if}
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="folderlist();"><a class="menu" href="javascript:folderlist()">{$smLabel.folders_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="search();"><a class="menu" href="javascript:search()">{$smLabel.search_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="addresses();"><a class="menu" href="javascript:addresses()">{$smLabel.address_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="emptytrash();"><a class="menu" href="javascript:emptytrash()">{$smLabel.empty_trash_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="prefs();"><a class="menu" href="javascript:prefs()">{$smLabel.prefs_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="goend();"><a class="menu" href="javascript:goend()">{$smLabel.logoff_mnu}</a></td>
  </tr>
</table>
