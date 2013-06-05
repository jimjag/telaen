INTRO:
This documents the changes made to Telaen.

First of all: Telaen would be nowhere without the
effort of many beta testers, other bug-and-patch submitters.

Telaen was originally based on Uebimiau.

LICENSE:
Telaen is released under the GPL.


CHANGELOG:

----------------------------------------------------------------
Telaen:
=======
1.3.2-dev

 [New] Update to Smarty 2.6.27

 [Fix] Correct bug w/ PHPMailer 5 compatibility

1.3.1

[Fix]	Sanitize f_email and redir url

1.3.0

[New]	Support for PHPMailer 5.2.1.

[New]	Now includes an embedded appointment/event Calendar
	using the iCal format under the hood.

[New]	Ability to display a System-wide "news" banner
	via inc/news/news.system.php

[New]	Major speed improvements when handling the POP3
	Inbox. Even though it's not recommended to store all
	your Email in the POP3 Inbox, lots of people do which
	slowed down Telaen.

[Fix]	No longer extracts vars willy-nilly from $_GET,
	$_POST, or $_FILES.

[Misc]	Moved all class.*.php files to ./inc/class/. and
	all config.* files to ./inc/config/. This means that
	upgrading may involve moving and/or deleting older
	stale versions of files.

[New]	Upgraded to latest TinyMce.

1.2.1

[New]	New Forwarded status flag and icon added.

[New]	Since ereg* is deprecated, all regexes now use the
	preg_* family.

[New]	Smarty upgraded to 2.6.26

[New]	PHPMailer upgraded to 2.0.3

[Fix]	Users cannot create folder that have the same names
	as system folders

1.2.0

[Released]

1.2.0-RC1

[New]	Updated Thai translation

[Fix]	Sorting by To in Sent Messages now works.

[Fix]	HTML Emails now have plain-text component, so that
	SpamAssassin doesn't score them too badly.

[Fix]	Fixed bug on IMAP when using prefix

1.2.0-beta1

[New]	Removed support for versions of PHP < 4.1.0

[New]	Smarty upgraded to 2.6.18.

[New]	Quota handling can now be set per user or per
	domain (or any combination) via the new $quota_limits
	config variable.

[New]	Uses POP3 UIDL for better message tracking. If server
	does not provide a UIDL, we create our own.

[New]	Email filters

[New]	Ajax function: session is mantained alive in the compose page,
	allowing writing long email without lose work.

[New]	Login page now alerts when you kicked out on a session expire.

[Fix]	Fixed regression with forward/reply of email with embedded
	images. downloads.php causes logout on recipient if uses telaen.

[Fix]	Various performance improvements

[Fix]	IMAP bug: extra text added on saved sent message cause wrong date/time display

[Fix]	Hide attachments links only if they are embedded images. Some clients (like pine)
	set Content-Id on all attachment types.

1.1.3

[New]	Added Malay translation

[New]	Updates to some languages

[New]	Included Outlook theme into package

[Fix]	Solved bug with imap when move or delete multiple message
	only one was moved or deleted.

1.1.3-rc2:

[Fix]	Added check for on CAPA detection, avoid hangs when command 
	is not supported.

[Fix]	Removed target->new on attach download (not open), causes blank
	window remains open on IE.

[New]	de lang up-to-date

1.1.3-rc1:

[Fix]	check_install.php(.txt) now correctly checks memory_limit
	value.

[New]	Now automatically detects if the POP3 server supports
	PIPELINING, APOP, ATOP and UIDL. Can be overruled
	(enable or disable) from config.php.

[Fix]	Email parsing enhancement, now can parse correctly
	multipart/alternative emails with multipart/mixed nested
	content. This emails are usually generate form Apple Mail Clients
	Also attachments types with dots (like application/vnd.ms-exel)
	are detected correctly.

[New]	Little usability issue, error/badlogin pages are merged with login 
	page, the errors are simply displayed in a box.	 This also removes
	unuseful/redudant code. To use this feature, themes need
	to update their login.htm file (look at default/login.htm
	for guidance).

[New]	TinyMce updated to version 2.0.9

[New]	New feauture: Button for download the entire message


1.1.2:

[New]	Moved to subversion. This allowed us to rearrange
	the default layout more easily and move the bundled Smarty
	package from underneath the telaen path.

[New]	Provide notice that the ./smarty/ directory
	should be moved someplace outside of the
	web-space. Done by renaming the directory.

[New]	Updated Smarty to 2.6.16
	Updated tinyMce to 2.0.8

[New]	Added korean language.

[Fix]	Fixed error when using TOP retrieve mode, the msg[size]
	contained an EOF that caused a bad response on the next
	command. Also improved the move function, the message is
	deleted only if the copy is done on filesystem.

[New]	Added APOP login support. To enable, add

		$mail_use_apop = yes;

	to your config.php file.

[Fix]	Better header parsing, support multi-line headers avoid
	wrong content-type detect.

[Fix]	Bug on attachment filename, sometimes the name ends with 
	';' when receving emails from Hotmail accounts.

[Fix]	Use the configured port on ONE-FOR-ALL mode, not depending
	from protocol.

[Fix]	Use relative path on redir.php links, avoid problems on 
	https servers.


1.1.1:

 * Fixed little bug on catch-address where wrong address was added
   to addressbook.

1.1.1-rc2:

 * Fixed problem where messages disappear on refresh with zero quota.

 * Little fixes on themes.

1.1.1-rc1:
 
 * Added sort for personal folders on folders list and fixed a
   bug can cause duplicate entries in the list.
 
 * Fixed problem with missing header info when using IMAP. Also
   addresses possible "double showing" of SPAM email both Inbox
   and Spam folder.

 * Solved issue when attached images with upcase or capitalized extension
   (like .JPG or .Gif) are not displayed inline

 * Added check for exclude user address in reply-all  

 * Added ability to require a return-receipt on a new message

 * Improved signature/footer attach and multiple quotes on HTML messages

 * umask value and default directory permission bitmask now
   configurable via the config.php file. Useful for some
   environs that need a more "open" permission setup.
   NOTE: this requires people upgrading from 1.1.0 or earlier
   to modify their config.security.php file! Look at the
   config.security.php.default file for these variable settings.

 * Templates improvements: 
	- now header.htm contains also the <head> section of html
	- meta tags output in <head> instead of a bad echo
	- menu.htm template used instead of nav_menu.htm 
	- webmail title configurable in config.php
	- little restyling on quick address window (mozilla style)
	- added a different header for popups

 * New check on quick address window, avoid to add an address multiple 
   times. 

1.1.0:

 * Updated Smarty to version 2.6.14

 * Added $phpmailer_sendmail and $phpmailer_timeout to
   config.php.default to allow admin to easily override
   PHPMailer's default sendmail path and SMTP timeout

 * Changed attachment window size to something large enough to
   be readable, but not too large.

1.1.0-rc2:

 * Updated TinyMCE to latest rev.

 * Fixed bug on email time calc.

 * Adjusted titles alignment an other little improvements on themes. 

1.1.0-rc1:

 * Fix bug where selected messages disappear from list
   on mark/unmark read functions with 20 or more messages.

 * Fix bug where auto-deleting SPAM could affect other
   messages in the INBOX.

 * Fix nasty bug where CC addresses were not being delivered
   if using the 'mail' Mailer (PHPMailer bug).
	
 * Templates improvement, now we have a page header and footer
   included in all pages (actually not for login and pop-ups).
   This allow a faster style personalization.

1.1.0-beta2:

 * Telaen is now aware of the SpamAssassin X-Spam-Level
   header, and allows users to control auto-SPAM detection
   sensitivity and SPAM folder autopopulation. For example,
   a user can specify a sensitivity of 2 (very sensitive),
   and all messages that have a X-Spam-Level of 2 or more
   will get auto-moved to the SPAM folder.

 * Bundled themes converted to be xhtml1.0 compliant.

 * Force magic_quotes_runtime to be disabled, since it
   conflicts with Smarty.

 * Fix issue with message lists when quotas are not used.

 * Provide ways to work around some issues with
   Redirects. We can now select whether these redirects
   are performed via HTTP redirects (the Location header)
   or via META REFRESH and Javascript (see $redirects_use_meta).
   Also, we can select whether the URLs used for redirects
   are absolute (as required by HTTP) or relative (see
   $redirects_are_relative).

 * New feature: mark as read/unread on message list

1.1.0-beta1:

 * Fixed problem with possible incorrect redirects. Instead
   of checking that $_SERVER['HTTPS'] is non-empty, we
   check explicitly for it being set to 'on'. The official
   PHP docs are misleading (wrong) here.

 * Add in extra/check_install.php.txt which performs some
   simple tests of your installation and setup.
   
 * No longer require short_open_tag.

 * Some under-the-hood code improvements.

 * Remove the SPAM folder from the list of
   "folders that stuff can be moved to by the
   user."

 * The Advanced HTML Editor is now TinyMCE, which
   is bundled with Telaen. Changes to the newmsg.htm
   template file may be required (depending on the
   template) to fully use this.

 * Now, whenever Telaen adds body content (eg: whenever
   we Decode), we choose to sanitize or not. This means
   that messages are sanitized when printed or
   forwarded/replied to. Added a global variable,
   $sanitize_html to control this ($allow_scripts
   also works, but is being depreciated since it
   doesn't reflect what we're really concerned about).

 * Fixed bug where show_body was not using the correct
   charset (since it was removed by HTMLFilter).

 * Removed old krufty session code to use native PHP session()
   capability.

 * Removed the tid/lid/sid stuff from the URL. Stored in
   user sessions, as it should be.

1.0.0:

 * Revised de.txt and pt_BR.txt files.
 
1.0.0-RC2:

 * Fix the default theme to use a draft Telaen logo
   instead of the old Uebimiau one.

 * The preferences page is now shown whenever the
   previously used version and the present version differ
   by either the Major or Minor version number. For example,
   moving from 1.0.0 to 1.0.1 will not make it happen, but
   going from 1.0.4 to 1.1.0 will. This therefore sets
   the assumption of what the "API" is :)

 * HTML Emails are now filtered through HTMLFilter,
   to protect against XSS attacks.

 * We no longer get that weird '1' on the upper left of
   the message list page.

 * Add in a method to adjust for server timezone offsets, if we
   can't figure out the real offset.

 * Use output buffering within process.php to prevent breakage
   with redirects.

 * Force exit after all redirects.

 * All redirects are now HTTP/1.1 compliant (ie: the use
   absolute URLs).

 * Some HTML cleanups for the default theme.

1.0.0-RC1:

 * Fix calculation of timezones.

 * Rename of class files and other notices from Uebimiau to
   Telaen.

 * Enable marking READ messages as either READ or
   UNREAD upon logout. The default is UNREAD. This allows
   users who check their mail with other Email clients
   to see those messages as "new" and unread. SysAdmin can
   overrule user prefs by setting:
      $force_unmark_read_overrule;
      $force_unmark_read_settingyes;
   in config.php.
   Changes:
     o en_UK.txt: prf_unmark_read_on_exit
     o preferences.htm

----------------------------------------------------------------
Uebimiau - the "jimjag" patches:
----------------------------------------------------------------
--------
2.7.8p3
--------
 * "What is SPAM" regex now definable for each UM class.

 * Enable auto-population of the spam folder and
   add a user pref to auto-delete it at logout time.
   Spam folder options require the _autospamfolder
   variable in the Uebimiau class be TRUE.
     o en_UK.txt: spam_extended
		  prf_empty_spam_on_exit
     o preferences.htm

 * Make the spam folder a system folder.

 * If using cookies, have the login page explain why
   a login may not have succeeded due to cookie error
   (eg: user does not have cookies enabled). Only important
   if using cookie security. This required changes to the
   login themes and the lang file.
     o en_UK.txt :lng_cookie_not_enabled
		  lng_cookie_not_valid
     o login.htm

 * Store version number in pref's file; since new versions
   might change or add preferences, this means that UM
   can now direct the user to their Preferences page
   as soon as the login after an upgrade (similar to
   the First Login). Updated preference page theme.
     o preferences.htm

 * Address book now usable with CC and BCC fields.
     o newmsg.htm

 * Fold in many improvements submitted by MBR (Martin
   Blapp) regarding file and folder speedups, detection
   of ATOP and pipelining support, and spam folders.

--------
2.7.8p2
--------
 * Change format of session ID to be more file system
   friendly.

 * Folders are now mode 700, for security.

 * No longer depend on the bundled versions of PHPMailer
   or Smarty, which were kind of old. Instead, force any
   custom changes to these external projects to be local
   in scope, allowing us to upgrade them as needed, or to
   use system-installed versions. (we *do* bundle what we
   need, for completeness, and to make it a one-shot
   installation - we just bundle the latest, non-altered
   versions, but we don't require the version we bundle).

 * Fix some incorrect regex matching, especially when they
   touch the file system (like allowed folder names).

 * Fix MSIE display errors (usually exhibited as just a
   blank page) especially with attachments.

 * On login, do the inbox/attachments clean-up. Many people
   don't bother to logout. :)

 * Auto-clean the server-side inbox and attachments
   folder to save disk space.

 * Misc code cleanups.

--
Jim Jagielski / jim@jaguNET.com

