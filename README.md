# Telaen - A full-featured yet simple web-based e-mail client written in PHP

## Overview

Telaen is a web-based e-mail client written in PHP. What is particularly
nice about Telaen is that it is fast, lean and simple, but also extremely
powerful. It does not require much more than a "standard" PHP
installation, nor does it require a database. It supports multiple
folders, POP3 and IMAP, is SPAM aware and incorporates a WYSIWYG editor
for Email composition. It supports multiple languages as well as
multiple themes (or "skins").

Telaen 1.3.x is compatible with PHP4 and PHP5. Starting with Telaen
2.x, support for PHP4 will be dropped.

Telaen was originally based on Uebimiau.

We recommend that you read the other documents in the docs/ subdirectory,
especially the CHANGELOG.txt and INSTALL.txt files.

## Why you might need it

Other PHP-based webmails require database support as well as a long
laundry-list of other PHP libs and extensions; not Telaen. If
you need an expandable, powerful yet simple webmail system,
Telaen will likely fit the bill.

And, if you are stuck running ancient Uebimiau, you should
really move to Telaen asap.

## License

Telaen is free software distributed under GPLv2 terms; see www.gnu.org for
more informations. You can use or redistribute this software, but need to
preserve the credits of author. Please read LICENSE for information on the
software availability and distribution.

## Features

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

## Localization
PHPMailer defaults to English, but supports other language and UI themes (or 'skins').

## Documentation

You'll find some basic user-level docs in the docs folder

## Dependencies

Telaen is designed to work with as a vanilla, bare-bones build of PHP as
possible. The below external dependencies are bundled for convenience:

- Smarty
- TinyMCE
- PHPMailer
- iCalCreator

Telaen is designed to work with both the bundled as well as the system-provided
versions of these tools.

No database is required.

## Contributing

Please submit bug reports, suggestions and pull requests to the [GitHub issue tracker](https://github.com/jimjag/telaen/issues).

We're particularly interested in fixing edge-cases, expanding test coverage and dropping support for PHP4, PHP5.1
and PHP5.2.

## Changelog

See CHANGELOG.md
