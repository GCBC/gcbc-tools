GCBC Tools
==========

Collection of simple tools to support Girton College Boat Club (GCBC).

Developed in PHP using the [CodeIgniter](http://codeigniter.com/) framework.

Author
------

Calum J. Eadie (https://github.com/CalumJEadie)

Licensing
---------

This copy of the CodeIgniter framework is licensed under the old style CodeIgniter license. See `documentation/CodeIgniter/license.txt`. This applies to `www/system`.

The remainder of this application is licensed under the MIT License. See `LICENSE.markdown`.

Tools
-----

* Itemised Bill Emailer
    * From a CSV file of names, email addresses and itemised costs generates and emails a per member itemised bill.
    * Outputs HTML and Text emails, email client decides which to display.
* Tracker
    * Originally written for GCBC's 2012km erg fundraiser in January 2012.
    * Tracks distance and time for teams and participants.
    * Outputs legs completed by teams and participants.
    * Basic HTTP API.
    * Embeddable progress tracker.
    * Export of legs to CSV.
    
Screenshots
-----------

### Itemised Bill Emailer

#### Input
![Input][1]

#### View Store
![View Store][2]

#### Send Emails
![Send Emails][3]

#### Email Output - HTML
![Email Output - HTML][4]

#### Email Output - Plain Text
![Email Output - Plain Text][5]

[1]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/itemised-bill-emailer/input.png
[2]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/itemised-bill-emailer/store.png
[3]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/itemised-bill-emailer/send.png
[4]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/itemised-bill-emailer/email-html.png
[5]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/itemised-bill-emailer/email-text.png

### Tracker

#### Teams
![Teams][6]

#### Participants
![Participants][7]

#### Runnings Legs
![Running Legs][8]

#### Completed Legs
![Completed Legs][9]

#### Progress tracker embedded in GCBC website
![Progress tracker embedded in GCBC website][10]

[6]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/tracker/teams.png
[7]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/tracker/participants.png
[8]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/tracker/legs-1.png
[9]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/tracker/legs-2.png
[10]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/tracker/gcbc-website.png

Installation
------------

Sensitive files are not included in the repo but masked copies can be found in `documentation/sensitive`.
