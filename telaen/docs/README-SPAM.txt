Telaen provides support for auto-SPAM detection and the
automatic movement of detected SPAM messages from the user's
Inbox to the user's SPAM folder. It does this via 2 methods:

  1. System-wide:
     The Telaen Administrator sets a regular expression
     (the default is "*****SPAM*****" and "*****VIRUS*****")
     that is scanned for in each Email message's Subject line.
     If the regex matches, that message is moved to the SPAM
     folder automatically.

  2. Per-User:
     Telaen is also aware of the SpamAssassin (and other)
     X-Spam-Level header, which provides a measurement
     on how "SPAM-worthy" this message is. A lower
     number means it does not have a lot of the characteristics
     of SPAM; a higher number means it does. The user can
     set their own personal preference on how sensitive
     they want to be in Telaen auto-populating the SPAM
     folder. If they set a high sensitivity (which
     corresponds to a lower number) than all messages
     at the level or higher will be automatically moved
     to the SPAM folder. A setting of '0' disables this.


It should be noted that Telaen itself does not scan or parse
the messages themselves to determine if they are SPAM. Instead,
it relies on that parsing/filtering already being down at
the MTA/MDA layer. Telaen simply uses the results of that
previously performed scanning to know what to do with
the message.
