GCBC Tools
==========

Collection of simple tools to support Girton College Boat Club (GCBC).

Developed in PHP using the [CodeIgniter](http://codeigniter.com/) framework.

Author
------

Calum J. Eadie (https://github.com/CalumJEadie)

Tools
-----

* Itemised Bill Emailer
    * From a CSV file of names, email addresses and itemised costs generating and emails a per member itemised bill
* Tracker
    * Originally written for GCBC's 2012km erg fundraiser in January 2012.
    * Tracks distance and time for teams and participants.
    * Outputs legs completed by teams and participants.
    * Basic HTTP API.
    * Embeddable progress tracker.
    * Export of legs to CSV.
    
Screenshots
-----------

### Tracker

#### Teams
![Teams][1]

#### Participants
![Participants][2]

#### Runnings Legs
![Running Legs][3]

#### Completed Legs
![Completed Legs][4]

#### Progress tracker embedded in GCBC website
![Progress tracker embedded in GCBC website][5]

[1]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/teams.png
[2]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/participants.png
[3]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/legs-1.png
[4]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/legs-2.png
[5]: https://github.com/CalumJEadie/gcbc-tools/raw/master/documentation/screenshots/gcbc-website.png

Installation
------------

Sensitive files are not included in the repo but masked copies can be found in `documentation/sensitive`.

Licensing
---------

This copy of the CodeIgniter framework is licensed under the old style CodeIgniter license. See `documentation/CodeIgniter/license.txt`. This applies to `www/system`.

The remainder of this application is licensed under the MIT License. See `LICENSE.markdown`.
