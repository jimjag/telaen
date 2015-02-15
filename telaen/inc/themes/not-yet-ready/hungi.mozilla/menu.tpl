<!-- Menu -->

<div id="menu">
  <div class="menuItem"> <a href="javascript:goinbox()"><img src="inc/themes/hungi.mozilla/images/inbox.gif" alt="" /></a>
    <p><a href="javascript:goinbox()">{$smLabel.messages_mnu}</a></p>
  </div>
  <div class="menuItem"> <a href="javascript:newmsg()"><img src="inc/themes/hungi.mozilla/images/compose.gif" alt="" /></a>
    <p><a href="javascript:newmsg()">{$smLabel.compose_mnu}</a></p>
  </div>
  {if $refresh neq "false"}
  <div class="menuItem"> <a href="javascript:refreshlist()"><img src="inc/themes/hungi.mozilla/images/refresh.gif" alt="" /></a>
    <p><a href="javascript:refreshlist()">{$smLabel.refresh_mnu}</a></p>
  </div>
  {else}
  <div class="menuItem"> <img src="inc/themes/hungi.mozilla/images/refresh.gif" alt="" />
    <p>{$smLabel.refresh_mnu}</p>
  </div>
  {/if}
  <div class="menuItem"> <a href="javascript:folderlist()"><img src="inc/themes/hungi.mozilla/images/folders.gif" alt="" /></a>
    <p><a href="javascript:folderlist()">{$smLabel.folders_mnu}</a></p>
  </div>
  <div class="menuItem"> <a href="javascript:search()"><img src="inc/themes/hungi.mozilla/images/search.gif" alt="" /></a>
    <p><a href="javascript:search()">{$smLabel.search_mnu}</a></p>
  </div>
  <div class="menuItem"> <a href="javascript:addresses()"><img src="inc/themes/hungi.mozilla/images/address.gif" alt="" /></a>
    <p><a href="javascript:addresses()">{$smLabel.address_mnu}</a></p>
  </div>
  <div class="menuItem"> <a href="javascript:emptytrash()"><img src="inc/themes/hungi.mozilla/images/trash.gif" alt="" /></a>
    <p><a href="javascript:emptytrash()">{$smLabel.empty_trash_mnu}</a></p>
  </div>
  <div class="menuItem"> <a href="javascript:prefs()"><img src="inc/themes/hungi.mozilla/images/preferences.gif" alt="" /></a>
    <p><a href="javascript:prefs()">{$smLabel.prefs_mnu}</a></p>
  </div>
  <div class="menuItem"> <a href="javascript:goend()"><img src="inc/themes/hungi.mozilla/images/logout.gif" alt="" /></a>
    <p><a href="javascript:goend()">{$smLabel.logoff_mnu}</a></p>
  </div>
</div>
<!--Menu end--> 
