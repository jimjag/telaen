<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://www.telaen.org/

*************************************************************************/

defined('I_AM_TELAEN') or die('Direct access not permitted');

########################################################################
# Load in the version information
########################################################################

########################################################################
# Location of the Smarty template installation.
# We bundle Smarty, but you can point it to your
# locally installed version if you like. Not matter
# what, make sure Smarty is not located under your
# public web-space. DO NOT USE THE BUNDLED VERSION
# AS IS WITHOUT MOVING IT TO A SAFE LOCATION
########################################################################

$config['SMARTY_DIR'] = '/some/place/safe/smarty/';

require('./inc/version.php');
$config['appversion'] = $appversion;
$config['appname'] = $appname;


########################################################################
# Read in $systemNews (not required)
########################################################################

@include('./inc/news/news.system.php');
$config['systemNews'] = $systemNews;


########################################################################
# _ Please attention _:
# The temporary files will be stored on this folder
# For security reasons, do not use web-shared folders

# ** The Web Server needs write-permission on this folder

# * Unix/Linux users use.
# /tmp/telaen
# * Win32 users
# c:/winnt/temp/telaen

# NEVER use backslashes (\). Always use forward slashes (/),
# for all operating systems, INCLUDING Windows

# For maximum security, do NOT place this under your web site
# folder !
########################################################################

$config['temporary_directory'] = './ChangeMe!/';

########################################################################
# Title prefix for webmail pages
########################################################################

$config['webmail_title'] = 'Telaen Webmail';

########################################################################
# Quota handling:
# Telaen allows for quotas to be set that limit the maximum size
# for all stored files and folders. For backwards compatibility
# there are 2 ways to set this:
#    $config['quota_limit']: Will be used as the system-wide default
#    $config['quota_limits']: An array which specifies, via regex, the
#		    quotas for various accounts. Each element of
#		    this array is an array which maps the user to
#		    their quote. The array is scanned sequentially
#		    so later matches override earlier ones (see
#		    example below)
#
# A value of 0|"" means no limit (and no quotas)
# NOTE: All values are in *bytes*, but you can append k|M|G for
#       kilobytes, Megabytes and Gigabytes
########################################################################

$config['quota_limit'] = '4096k';  //  in KB, eg. 4096 Kb = 4MB

##
# Example of quota limit array. All users from @example.com
# will have a quota of 4megs!, except jim@example.com who will
# have his quota disabled. Recall that this array is scanned
# sequentially... If the order was reverse, then jim would
# also be set to 4M as well!
##
$config['quota_limits'] = array (
    array ('/@example.com/i', '4M' ),
    array ('/jim@example.com/i', 0)
);

########################################################################
# Mail server type:
# allowed values:

# 'DETECT' -------->	Guess the pop3 server. If you are running Telaen
#			in a domain 'www.company.com', the script will
#			use 'PREFIX.company.com' as your server. you
#			can set the 'PREFIX' in the var $config['mail_detect_prefix'].
#			Also, the var $config['mail_detect_remove'] can be set
#			to 'www.', then the script get rid the 'www' and
#			put the prefix, eg. pop3.company.com.br

#'ONE-FOR-EACH' -->	Each domain have your own mail server.
#			The script will load the list of domains/servers from
#			var $config['mail_servers'].

#'ONE-FOR-ALL' --->	If you use this option, your users must supply the
#			full email address as username. You can set the mail
#			server in the var $config['default_mail_server']
#

# LOGIN_TYPE

# Note. You can supply the LOGIN_TYPE according to your MAIL SERVER.
# Eg. If your mail server requires usernames in user@domain.com, you must
# specify the LOGIN_TYPE as '%user%@%domain%'. You can combine it according to
# your server. eg.

# %user%
# %user%@%domain%
# %user%.%domain%
#
# PROTOCOL and PORT
# Choose 'imap' as protocol to use the Internet Mail Access Protocol,
# or 'pop3' to use the Post Office Protocol.
# The default ports are:
# pop3 -> 110
# imap -> 143
# The imap is more fast, but all functions of Telaen works with POP3
########################################################################

########################################################################

$config['mail_server_type'] = 'ONE-FOR-ALL';

########################################################################
# TYPE: DETECT
########################################################################

$config['mail_detect_remove'] = 'www.';
$config['mail_detect_prefix'] = 'mail.';
$config['mail_detect_login_type'] = '%user%@%domain%';
$config['mail_detect_protocol'] = 'pop3';
$config['mail_detect_port'] = '110';
$config['mail_detect_folder_prefix'] = "";

########################################################################
# TYPE: ONE-FOR-EACH
# Each domain have your own mail server
#
# Note: If you set only one domain, the users are forced to use a single
# mail server. Can be useful if you want to type only your mail name
# instead of a complete mail address at login.
# (example: frank instead of frank@telaen.org)
########################################################################


$config['mail_servers'][] = array(
	'domain' 	=> 'domain.com',
	'server' 	=> 'pop3.domain.com',
	'login_type' 	=> '%user%',
	'protocol'	=> 'pop3',
	'port'		=> '110',
	'folder_prefix'	=> ""
);


/*
$config['mail_servers'][] = array(
	'domain' 		=> 'another-domain.com',
	'server' 		=> 'mail.another-domain.com',
	'login_type' 	=> '%user%@%domain%',
	'protocol'		=> 'imap',
	'port'			=> '143',
	'folder_prefix'	=> 'INBOX.'
);

*/

########################################################################
# TYPE: ONE-FOR-ALL
# the default mail server for all domains
########################################################################

$config['default_mail_server'] = 'localhost';
$config['one_for_all_login_type'] = '%user%@%domain%';
$config['default_protocol'] = 'pop3';
$config['default_port'] = '110';
$config['default_folder_prefix'] = "";

########################################################################
# In some POP3 servers, if you send a 'RETR' command, your
# message will be automatically deleted :(
# This option prevents this inconvenience. Assumes
# that the server supports TOP
########################################################################

$config['mail_use_top'] = false;

########################################################################
# These enable you to overrule the automatic detection of
# the following POP3 server capabilities: PIPELINING, ATOP,
# UIDL and APOP. If you find that Telaen is using one of these
# when it shouldn't, uncomment out the respective variable
# setting and set it to '0'. If the reverse is happening, and
# Telaen is not using/detecting a capability you *know* your
# POP3 server has, then uncomment out the variable line and
# set it to 1.
#
# PIPELINING: the POP3 server is capable of accepting multiple
#             commands at a time; Telaen does not have to wait for
#             the response to a command before issuing a subsequent
#             command.
# ATOP: Faster varient of normal POP3 TOP
# UIDL: the server can provide an assigned unique ID for each POP3
#       message
# APOP: provides an encrypted login system instead of clean password sent.
#
# NOTE: You can add your own as needed
########################################################################

##
## COMPATIBILITY NOTE:
##   Telaen 1.x used:
##	$mail_use_pipelining= no;
##	$mail_use_atop = no;
##	$mail_use_uidl = no;
##	$mail_use_apop = no;
#
#$config['capa_override'] = array(
#	'ATOP' = 0;
#	'UIDL' = 0;
#	'PIPELINING' = 0;
#	'APOP' = 0;
#);

$config['capa_override'] = array();

########################################################################
# Specify mail transport type
# Allowed values:
# 'smtp'       - To use an external SMTP Server specified in
#                $config['smtp_server']
# 'sendmail'   - To use server's sendmail-compatible MTA. If you need to
#                change the path, see $config['phpmailer_sendmail'] below
# 'mail'       - To use default PHP's mail() function
########################################################################

$config['mailer_type'] = 'mail';

########################################################################
# Telaen uses PHPMailer for many mailing functions. Sometimes we
# need or want to override PHPMailer defaults for the path to
# 'sendmail' (see the 'sendmail' mail transport type, above)
# or the time used when PHPMailer opens an SMTP connection. The
# 2 following variables allow that.
#
# NOTE: These are only used if they are non-NULL and non-0
#
# Examples:
#    $config['phpmailer_sendmail'] = '/usr/lib/sendmail';
#    $config['phpmailer_timeout'] = 60;
########################################################################

$config['phpmailer_sendmail'] = "";
$config['phpmailer_timeout'] = 0;

########################################################################
# Your local SMTP Server (alias or IP) such as 'smtp.yourdomain.com'
# eg. 'server1;server2;server3'   -> specify main and backup server
########################################################################

$config['smtp_server'] = 'localhost';  #YOU NEED CHANGE IT !!

########################################################################
# Use SMTP password (AUTH LOGIN type)
########################################################################

$config['use_password_for_smtp'] = true;

########################################################################
# Use static authentication info for smtp.
# Always the same user and password will be used for smtp authentication
# instead of user data.
# Useful when you have multiple incoming domains but a single SMTP
# Note: You need to enable also the option above.
########################################################################

$config['smtp_static_auth'] = false;
$config['smtp_static_user'] = 'yourSmtpUser';
$config['smtp_static_password'] = 'yourSmtpPasswd';

########################################################################
# Add a 'footer' to sent mails
########################################################################

$config['footer'] = "

________________________________________________________________
Message sent using $appname $appversion
";


########################################################################
# Redirect new users to the preferences page at first login
########################################################################

$config['check_first_login'] = true;

########################################################################
# Turn this option to 'true' if you want allow users send messages using
# they 'Reply to' preference's option as your 'From' header, otherwise
# the From field will be the email wich the users log in
########################################################################

$config['allow_modified_from'] = true;

########################################################################
# Order setting
########################################################################

$config['default_sortby'] = 'date';
$config['default_sortorder'] = 'DESC';

########################################################################
# Default preferences...
########################################################################

$config['default_preferences'] = array(
	'send_to_trash_default' 	=> true,		# send deleted messages to trash
	'st_only_ready_default' 	=> true,		# only read messages, otherwise, delete it
	'save_to_sent_default'		=> true,		# send sent messages to sent
	'empty_trash_default'		=> true,		# empty trash on logout
	'empty_spam_default'		=> true,		# empty spam on logout
	'unmark_read_default'		=> false,		# Unmark READ messages as read (appear as unread)
	'sortby_default'		=> 'date',	# alowed: 'attach','subject','fromname','date','size'
	'sortorder_default'		=> 'DESC',	# alowed: 'ASC','DESC'
	'rpp_default'			=> 20,		# records per page (messages), alowed: 10,20,30,40,50,100,200
	'add_signature_default'		=> false,		# add the signature by default
	'require_receipt_default'	=> false,		# require read receipt by default
	'signature_default'		=> "",		# a default signature for all users, use text only, with multiple lines if needed
	'timezone_default'		=> '-0000',	# timezone, format (+|-)HHMM (H=hours, M=minutes)
	'display_images_default'	=> true,		# automatically show attached images in the body of message
	'editor_mode_default'		=> 'text',	# use 'html' or 'text' to set default editor.
	'refresh_time_default'		=> 10,		# after this time, the message list will be refreshed, in minutes
	'spamlevel_default'		=> 0		# Sensitivity to X-Spam-Level detection
	);

########################################################################
# Sometimes, we cannot figure out the correct timezone for the
# server, as compared to the user. So setting the user timezone
# to, for example '-0500' when the server is '-0800' results
# in the mail time display being 3 hours off. To adjust for
# this, set $config['server_timezone_offset'] to the correct
# adjustment (that is, '-0300') . For most sites, this isn't required.
########################################################################

$config['server_timezone_offset'] = '-0000';

########################################################################
# Control whether the SysAdmin overrules the unmark READ messages
# user preference. To use, set $config['force_unmark_read_overrule'] to
# true (if you want to overrule whatever the user has set)
# and set $config['force_unmark_read_setting'] to the value you wish
# to force.
########################################################################

$config['force_unmark_read_overrule'] = false;
$config['force_unmark_read_setting'] = false;

########################################################################
# Control whether redirects will use META REFRESH and Javascript
# to send the person to the required page ('true') or whether to
# use the HTTP Location header and do a 'real' HTTP redirect. Some
# browsers have issues setting Cookies during HTTP redirects, in
# those cases, setting the below to 'true' will help.
########################################################################

$config['redirects_use_meta'] = false;

########################################################################
# Control whether redirects refer to an absolute or relative URL.
# HTTP redirects are required to be absolute, but in some environments
# Telaen has a hard time determining what the absolute URL should be.
# Setting the below to 'true' avoids this.
########################################################################

$config['redirects_are_relative'] = false;

########################################################################
# Enable mailserver debug :)
# false - disabled
# true - enabled with servers communications
########################################################################

$config['enable_debug'] = false;

########################################################################
# Show debug infos on smtp communications
########################################################################

$config['smtp_debug'] = false;

########################################################################
# When $config['log_errors'] is enabled, PHP errors are printed to
#      $config['log_fname'].
# $config['log_fname'] is relative to $config['temporary_directory']
#      unless $config['log_fname'] is an absolute path
########################################################################

$config['log_errors'] = true;
$config['log_fname'] = 'telaen_error.log';

########################################################################
# Enable visualization of HTML messages
# *This option afect only incoming messages, the  HTML editor
# for new messages (compose page) is automatically activated
# when the client's browser support it (IE5 or higher)
########################################################################

$config['allow_html'] = true;

########################################################################
# FILTER javascript (and others scripts) from incoming messages
##  $config['allow_script'] is DEPRECIATED and exists for backward
##  compatibility only. Instead, use $config['sanitize_html']
########################################################################
$config['allow_scripts'] = false;
$config['sanitize_html'] = true;


########################################################################
# Block external images.
# If an HTML message have external images, it will be
# blocked. This feature prevent spam tracking
########################################################################

$config['block_external_images'] = false;

########################################################################
# Session timeout for inactivity
########################################################################

$config['idle_timeout'] = 20; //minutes

########################################################################
# Require cookies enabled to handle session
########################################################################

$config['enable_cookies'] = true;

########################################################################
# Control the default permissions of files and directories created
# by Telaen. For max security, the value of $config['default_umask']
# should be 0077 and $config['dirperm'] should be 0700, but in shared
# environments, this may need to be adjusted
########################################################################

$config['default_umask'] = 0077;
$config['dirperm'] = 0700;

########################################################################
# Language & themes settings
########################################################################

$config['allow_user_change_theme'] = true; //allow users select theme
$config['default_theme'] = 'default'; //key of theme, starting with zero
$config['allow_user_change_language'] = true; //allow users select language
$config['default_language'] = 'en_US'; //key of language

# Themes
$config['themes'] = array(
    'default' => 'Telaen Default',
    'hungi.mozilla' => 'Hungi Mozilla',
    'outlook' => 'MS Outlook',
    'jagumail' => 'jaguMail'
);

# Languages
## This is extremely ambitious

$config['languages'] = array(
    'afr' => 'Afrikaans',
    'sq_AL' => 'Albanian (Shqip)',
    'ar'    => 'Arabic (العربية)',
    'hy_AM' => 'Armenian (Հայերեն)',
    'az_AZ' => 'Azerbaijani (Azərbaycanca)',
    'eu_ES' => 'Basque (Euskara)',
    'be_BE' => 'Belarusian (беларуская мова)',
    'bn_BD' => 'Bengali (বাংলা)',
    'bs_BA' => 'Bosnian (Bosanski)',
    'bg_BG' => 'Bulgarian (Български)',
    'ca_ES' => 'Catalan (Català)',
    'zh' => 'Chinese (简体中文)',
    'hr_HR' => 'Croatian (Hrvatski)',
    'cs_CZ' => 'Czech (Česky)',
    'da_DK' => 'Danish (Dansk)',
    'nl_NL' => 'Dutch (Nederlands)',
    'en_US' => 'English (US)',
    'eo'    => 'Esperanto',
    'et_EE' => 'Estonian (Eesti)',
    'fo_FO' => 'Faroese (Føroyskt)',
    'fil' => 'Filipino',
    'fi_FI' => 'Finnish (Suomi)',
    'fr_FR' => 'French (Français)',
    'gl_ES' => 'Galician (Galego)',
    'ka_GE' => 'Georgian (ქართული)',
    'de_DE' => 'German (Deutsch)',
    'el_GR' => 'Greek (Ελληνικά)',
    'hat' => 'Haitian Creole',
    'he_IL' => 'Hebrew (עברית)',
    'hi_IN' => 'Hindi (हिनदी)',
    'hu_HU' => 'Hungarian (Magyar)',
    'is_IS' => 'Icelandic (Íslenska)',
    'id_ID' => 'Indonesian (Bahasa Indonesia)',
    'ga_IE' => 'Irish (Gaedhilge)',
    'it_IT' => 'Italian (Italiano)',
    'ja_JP' => 'Japanese (日本語)',
    'kan' => 'Kannada',
    'km_KH' => 'Khmer (ភាសាខ្មែរ)',
    'ko_KR' => 'Korean (한국어)',
    'ku'    => 'Kurdish (Kurmancî)',
    'lao' => 'Lao',
    'lv_LV' => 'Latvian (Latviešu)',
    'lt_LT' => 'Lithuanian (Lietuviškai)',
    'mk_MK' => 'Macedonian (Македонски)',
    'ms_MY' => 'Malay (Bahasa Melayu)',
    'ml_IN' => 'Malayalam (മലയാളം)',
    'mlt' => 'Maltese',
    'mri' => 'Maori',
    'mr_IN' => 'Marathi (मराठी)',
    'khk' => 'Mongolian',
    'ne_NP' => 'Nepali (नेपाली)',
    'nb_NO' => 'Norwegian (Bokmål)',
    'fa_IR' => 'Persian (فارسی)',
    'pl_PL' => 'Polish (Polski)',
    'pt_PT' => 'Portuguese (Português)',
    'ro_RO' => 'Romanian (Româneşte)',
    'ru_RU' => 'Russian (Русский)',
    'sr_CS' => 'Serbian (Српски)',
    'sk_SK' => 'Slovak (Slovenčina)',
    'sl_SI' => 'Slovenian (Slovenščina)',
    'som' => 'Somali',
    'es_ES' => 'Spanish (Español)',
    'swh' => 'Swahili',
    'sv_SE' => 'Swedish (Svenska)',
    'th_TH' => 'Thai (ไทย)',
    'tr_TR' => 'Turkish (Türkçe)',
    'uk_UA' => 'Ukrainian (Українська)',
    'ur_PK' => 'Urdu (اُردو)',
    'vi_VN' => 'Vietnamese (Tiếng Việt)',
    'xwg' => 'Yiddish',
    'yor' => 'Yoruba',
    'zul' => 'Zulu'
);

