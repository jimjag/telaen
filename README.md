# Telaen - A full-featured yet simple web-based e-mail client written in PHP

## Overview

Telaen is a web-based e-mail client written in PHP. What is particularly
nice about Telaen is that it is fast, lean and simple, but also extremely
powerful. It does not require much more than a "standard" PHP
installation, nor does it require an external database. It supports multiple
folders, both POP3 and IMAP, is SPAM aware and incorporates WYSIWYG editors
for Email composition. It supports multiple languages as well as
multiple themes (or "skins").

Telaen 1.3.x is compatible with PHP4 and PHP5. Starting with Telaen
2.x, we require PHP 5.4 and later.

We recommend that you read the other documents in the docs/ subdirectory,
especially the CHANGELOG.txt and INSTALL.txt files.

## Design Philosophy

First of all, Telaen is designed and architectured to be as small
and as compact as possible; some may even say Telaen is "minimalistic".
The reason is that as projects get larger and more complex, they are
more difficult to update, to vet and review, and to keep secure.
Simplicity, after all, is a virtue.

The other basic philosophy is to leverage PHP and existing 3rd
party libraries as much as possible, but without making the level
of dependencies onerous for the sys-admin. There's no need to
re-create the wheel, unless we can do it faster, or easier.

Finally, as ex-sys-admins ourselves, as well as developers,
Telaen is designed to be plug-and-play. Plugins are a great
idea, and maybe Telaen will support them in the future, but
requiring sys-admins to find, install, config and debug Plugins
to add basic features that should be core to a webapp, doesn't
make sense to us.

## Why you might need it

Other PHP-based webmails require external database support as well as a long
laundry-list of other PHP libs and extensions; not Telaen. If
you need an powerful yet simple and clean webmail system, Telaen will likely fit the bill.

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
- Personalized ordering of messages
- Personal preferences
- HTML e-mail support (read/write)
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
- vCard-parser (https://github.com/jimjag/vCard-parser fork)
- Html2Text.php

Telaen is designed to work with both the bundled as well as the system-provided
versions of these tools.

No external database is required.

## Contributing

Please submit bug reports, suggestions and pull requests to the [GitHub issue tracker](https://github.com/jimjag/telaen/issues).

We're particularly interested in fixing edge-cases, expanding test coverage and freshing-up
the user UI.

## Changelog

See [CHANGELOG.md](https://github.com/jimjag/telaen/blob/master/CHANGELOG.md)
