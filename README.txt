Web UI for Serviio
Front End for Serviio

Requirements: HTTP server, PHP5 (with XML simple and cURL), JavaScript-enabled web browser.
Serviio 1.0.0 or higher required.

TODO:
- better error management
- maybe some controls (start/stop) of the status refreshes
- better notification of when new version of Web UI and Serviio exist

CHANGELOG:
- 1.0 - 3/1/2012 - Release of new version
- 1.1 - 6/24/2012 - Updates to work with Serviio 1.0
- 1.2 - 8/12/2012 - Final release for Serviio 1.0 including 1.0.1
- 1.3 - 12/13/2012 - Added separate media browser URL in config.php
                   - Added Serviio License Key import on About page
                   - Added Serviidb.com support to add to Online Sources
                   - Small number of code enhancements
                   - Added new external library from datatables.net
                   - Added jQuery UI custom Aristo Theme
                   - Added refresh after exiting license upload dialog
                   - Added Image tab under Metadata tab
                   - Tested to work with Serviio 1.1
- 1.4b1 - 04/05/2013 - Various code enhancements
                     - Language selection in console tab now working (fixed wrong cookie path)
                     - Improved multilanguage support, added new language tags
                     - Updated German translation
                     - Page is reloaded to discard changes on reset button press
                     - Media browser link now accessess the bound interface IP
                     - Status tab lets you now chose the bound network interface (Serviio API 1.2)
                     - Transcoding settings now working again (Serviio API 1.2)
                     - Added new subtitle options (Serviio API 1.2)
                     - Added new remote options (Serviio API 1.2)
                     - Tested to work with Serviio 1.21
- 1.4b2 - 05/06/2013 - Fixed library changes not savable in free version
                     - Improved multilanguage support
                     - Updated German translation


HISTORY:
This app was originally written by acidumirae@gmail.com and kudos goes to his work.
My goal is to keep the development of Web UI active and to continue to improve the application.

ANNOUNCEMENTS:
http://forum.serviio.org/viewtopic.php?f=5&t=1310

Questions? mailto:mpemberton5@gmail.com

Like the app?  Go to www.markpemberton.com and donate a few bucks for a good cup of coffee!


TODO:
Change images in library screens
Hide Remote tab if FREE edition
Optionalize the location of the Online Resources tab (either on the main tab list or where it is now)
If adding from Online Source, check for duplicates
Add Installed Plugins tab?  Or just have it as an option under About?
sorting of OS items?
