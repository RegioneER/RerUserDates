# RerUserDates plugin for Matomo Analytics

[![Catalogo del riuso software](https://img.shields.io/badge/Riuso%20AGID-Software-%230076e3)](https://developers.italia.it/it/pa/r_emiro)
[![Matomo version](https://img.shields.io/badge/matomo-4.x--dev-success)](https://github.com/matomo-org/matomo)
[![Matomo version](https://img.shields.io/badge/matomo-3.x--dev-success)](https://github.com/matomo-org/matomo)
[![GitHub license](https://img.shields.io/github/license/RegioneER/RerUserDates)](https://github.com/RegioneER/RerUserDates/blob/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/RegioneER/RerUserDates)](https://github.com/RegioneER/RerUserDates/issues)
[![GitHub forks](https://img.shields.io/github/forks/RegioneER/RerUserDates)](https://github.com/RegioneER/RerUserDates/network)

## Description

This [Matomo](https://matomo.org) Plugin hides custom date range selection from calendar for regular users and avoids users setting dynamic ranges as default value in their personal profile.

When a user asks for a ranged date report, Matomo stats building it on the fly during browsing. This may slow down Matomo installation in case is loaded by visits and you have a large number of tracked websites.

Activity is resource intensive so that live tracking may become slow or inaccurate.

The main feature is regular users can't select any custom range in the calendar, only users having _Superadmins_ privilege still can.

Second feature is removing dynamic choices in the field _"Report date to load by default"_ in _User Settings page_ for all regular users.

Users profiles with _Superadmin_ privilege still untouched and user profiles of _Website Administrators_ will only display a notification about plugin's behavior.

_Superadmin_ can enable or disable the two features independently by clicking checkboxes in the plugin's configuration page in the web interface.

This plugin came translated in every language available in the [Weblate app](https://hosted.weblate.org/projects/matomo/communityplugin-reruserdates/).

Using that application, can officially contribute easily by adding your mothertongue language, or by editing missing strings. 
