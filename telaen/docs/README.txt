----------------------------------------------------
OVERVIEW
----------------------------------------------------
Telaen is a web-based e-mail client written in PHP. What is particularly
nice about Telaen is that it is fast, lean and simple, but also extremely
powerful. It does not require much more than a "standard" PHP
installation, nor does it require a database. It supports multiple
folders, POP3 and IMAP, is SPAM aware and incorporates a WYSIWYG editor
for Email composition. It supports multiple languages as well as
multiple themes (or "skins").

Telaen 1.3.x is compatible with PHP4 and PHP5. Starting with Telaen
2.x, support for PHP4 will be dropped.

Telaen is free software distributed under GPL terms; see www.gnu.org for
more informations. You can use or redistribute this software, but need to
preserve the credits of author.

Telaen was originally based on Uebimiau.

We recommend that you read the other documents in the docs/ subdirectory,
especially the CHANGELOG.txt and INSTALL.txt files.

----------------------------------------------------
DEVELOPER
----------------------------------------------------
Core Developer: 
- The Telaen Group (www.telaen.com)


----------------------------------------------------
FEATURES/REQUIREMENTS
----------------------------------------------------

* Working
----------------------------------------------------
- SMTP Compatible
- POP3 Compatible
- IMAP Compatible
- MIME Compatible
- Receive Attachments
- Send Attachments
- Folders/E-mail management support (Trash/Inbox/Sent/[Personal])
- Address book
- Language support
- Themes support
- Search in messages
- Personalized order messages
- Personal preferences
- Send HTML e-mails
- Quota Limit
- Auto population of SPAM folder for tagged SPAM messages

* Planned
- Optional database support
- Plugin API

* NOT Planned
----------------------------------------------------
- PHP3 Port


* Dependences
----------------------------------------------------
--with-imap PHP module - NO        - Have own functions.
Sendmail/Qmail         - OPTIONAL  - Manage SMTP servers manually
Operational System OS  - NO        - Cross plataform
Database               - NO        - Manage data in hard disk
Client Cookies         - OPTIONAL  - Manage session manually
Client JavaScript      - YES       - To make templates more easy
PHP                    - YES       - Sure ;)
Smarty                 - YES       - Bundled with Telaen
                                     but you can use your
                                     own. Be sure to copy the
                                     function.um_welcome_message.php.txt
                                     file to your plugins folder (rename
                                     it to function.um_welcome_message.php)!
                                     If you use the bundled version,
                                     BE SURE to move it outside of the
                                     public web space.
PHPMailer              - YES       - Bundled with Telaen
                                     but you can use your
                                     own
