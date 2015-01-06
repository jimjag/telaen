<!-- menu template -->

<table cellspacing="1" cellpadding="3" width="100%" border="0" bgcolor="White">
  <tr>
    <td bgcolor="#EEE5DE">{$webmailTitle}</td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE"><ul class="menuFldList">

      <!-- sys folders --> 
      {section name=sysFolder loop=$umSystemFolders}
      <li class="menuFldItem"><a class="menu" href="{$umSystemFolders[sysFolder].link}">{$umSystemFolders[sysFolder].name}</a></li>
      {/section} 

      <!-- personal folders --> 
      {section name=persFolder loop=$umPersonalFolders}
      <li class="menuFldItem"><a class="menu" href="{$umPersonalFolders[persFolder].link}">{$umPersonalFolders[persFolder].name}</a></li>
      {/section} </td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="newmsg();"><a class="menu" href="javascript:newmsg()">{$umLabel.compose_mnu}</a></td>
  </tr>
  {if $refresh neq "false"}
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="refreshlist();"><a class="menu" href="javascript:refreshlist()">{$umLabel.refresh_mnu}</a></td>
  </tr>
  {/if}
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="folderlist();"><a class="menu" href="javascript:folderlist()">{$umLabel.folders_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="search();"><a class="menu" href="javascript:search()">{$umLabel.search_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="addresses();"><a class="menu" href="javascript:addresses()">{$umLabel.address_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="emptytrash();"><a class="menu" href="javascript:emptytrash()">{$umLabel.empty_trash_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="prefs();"><a class="menu" href="javascript:prefs()">{$umLabel.prefs_mnu}</a></td>
  </tr>
  <tr>
    <td bgcolor="#EEE5DE" onmouseover="mOvr(this,'#D1D7ED');" onmouseout="mOut(this,'#EEE5DE');" onclick="goend();"><a class="menu" href="javascript:goend()">{$umLabel.logoff_mnu}</a></td>
  </tr>
</table>
