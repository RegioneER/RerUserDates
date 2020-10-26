# «Hide Custom Ranges» is a RerUserDates plugin for Matomo Analytics

[![Catalogo del riuso software](https://img.shields.io/badge/Riuso%20AGID-Software-%230076e3)](https://developers.italia.it/it/search?type=reuse_software)
[![Matomo version](https://img.shields.io/badge/matomo-4.x--dev-success)](https://github.com/matomo-org/matomo)
[![Matomo version](https://img.shields.io/badge/matomo-3.x--dev-success)](https://github.com/matomo-org/matomo)
[![GitHub license](https://img.shields.io/github/license/RegioneER/RerUserDates)](https://github.com/RegioneER/RerUserDates/blob/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/RegioneER/RerUserDates)](https://github.com/RegioneER/RerUserDates/issues)
[![GitHub forks](https://img.shields.io/github/forks/RegioneER/RerUserDates)](https://github.com/RegioneER/RerUserDates/network)

## Description

This [Matomo](http://Matomo.org) Plugin hides custom date range selection from calendar for regular users and avoids users setting dynamic ranges as default value in their personal profile.

When a user asks for a ranged date report, Matomo stats building it on the fly during browsing. This may slow down Matomo installation in case is loaded by visits and you have a large number of tracked websites.

Activity is resource intensive so that live tracking may become slow or inaccurate.

The main feature is regular users can't select any custom range in the calendar, only users having _Superadmins_ privilege still can.

Second feature is removing dynamic choices in the field _"Report date to load by default"_ in _User Settings page_ for all regular users.

Users profiles with _Superadmin_ privilege still untouched and user profiles of _Website Administrators_ will only display a notification about plugin's behavior.

_Superadmin_ can enable or disable the two features independently by clicking checkboxes in the plugin's configuration page in the web interface.

This plugin came translated in: English, Italian and French. For more languages to come, just file a pull request adding a new `lang/*.json` file in your mother language, (see _Can I contribute_ f.a.q.)

## Installation

You can easily install the plugin by Matomo's Marketplace web interface.

Or please, read official [Matomo's documentation](http://Matomo.org/faq/plugins/#faq_21) about plugins installation.

## FAQ

**I would like to see a demonstration...**
Just take a look at _screenshots_ .

**Can I donate to you?**
Thanks but we can't accept money donations because we're a Government Organization.
Just feel free to contribute the source code.

**Can I contribute on development?**
New languages translations are welcome!
Sure, you can, just file a [pull request on Github](https://github.com/RegioneER/RerUserDates/pull)

## Changelog

### v3.0

Since this version, this plugin is Matomo 4 compatible

- Project's refactoring for Matomo 4.x-dev environment
- AGID's Publiccode inclusion for [«Catalogo del Riuso»](https://developers.italia.it/it/search?type=reuse_software) ([«Reuse Catalog» in english](https://developers.italia.it/en/search?type=reuse_software)) inclusion

### v.2.0

Adding Matomo 3.x plugin compatibility, Piwik 2.x is deprecated and no more supported. Please download v.1.x for older versions.

### v.1.3

- Settings environment breaks compatibility with Matomo versions < 2.8.0, thanks to @ThaDafinser.

### v.1.2

- New plugin settings user interface for super admins, some better improvement and few bugs solved.
- Solved a regression due to a lack of Settings Feature in Matomo's versions below 2.4.0
- Merged French translation
- Fixed Matomo compatibility with 2.10 from 2.7 by @ThaDafinser in PR #6

### v1.1

- Custom date range selection is disabled in the calendar only for regular users. A shorts jQuery snippet hides radio input and submit button.
- Regular users who chose a range date as their default are now forced to _yesterday_ report just visiting the index page with a warning notification.
- New French translation by @gaumondp

### v1.0

- First release and Marketplace integration
- User Manager screen shot and better readme documentation

## License

This is free software distributed under [GPLv3](http://www.gnu.org/licenses/gpl-3.0-standalone.html) license or later

## Support

You can ask for support and your feedback is appreciated at plugin's [issue center on Github](https://github.com/RegioneER/RerUserDates/issues).
