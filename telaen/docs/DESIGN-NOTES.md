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

## Design Notes

####'keep_on_server_default'  
This is likely the key aspect on the internal design and flow of Telaen.
Recall that email messages can live in 2 separate places: On the actual Email
server and/or on the webmail server on which Telaen is running.
For *POP3*, the optimal settings depends on whether or not the end-user
uses Telaen as their sole EMail client, or if they use it as a supplement for
their regular EMail client (like when traveling); For the former, the best
setting in **false**; for the latter, **true**.

This is because for *POP3*, it simply determines if messages from the Inbox (the only folder
for *POP3*) on the *POP3* server remain there or not (to be, for example, also read
by another EMail client). If `'keep_on_server_default'` is **true**, we only cache Inbox messages via SQLite3 but we never remove them **unless** they are deleted or moved. If **false**, then as we *READ* messages, then are removed from the server
and stored locally. This creates a sort of "dual" Inbox: one on the server and the other locally, with the ones on the server being those unread. In simpler terms, **true** doesn't change the Inbox on the server side (unless the message is
explicitly moved/deleted), and **false** keeps just *UNREAD* messages on the
*POP3* server's Inbox. Of course, any folders and their messages just live on the
*webmail* server itself.

For *IMAP* it is a little different. *IMAP* allows for folders, and was designed
to allow for all management of email messages and folders to stay on the EMail
server itself (as opposed to *POP3*, which expected messages to be moved from
it "immediately"). When using *IMAP*, if `'keep_on_server_default'` is **true**,
the Telaen is a simply front-end to the *IMAP* server itself, and simply
uses a local cache to speed things up. So all messages and folders remain
on the *IMAP* server, and local copies exist only for performance reasons
(and go away when the user logs-out). If **false**, then folders dual-exist on
the *IMAP* server and the *webmail* server, but are synced from the *IMAP* server
to the *webmail* server whenever accessed. (eg: say there are 5 messages on
*webmail* server in folder *Foo*, and 2 messages are delivered to the *Foo*
folder on the *IMAP* server, when the user logs in, and lists messages for
*Foo*, those 2 messages are moved **from** the *IMAP* server **to** the *webmail*
server, and the *webmail* *Foo* folder now contains 7 messages and the *IMAP*
folder is empty)