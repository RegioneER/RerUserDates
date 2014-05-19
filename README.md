# Piwik RerUserDates Plugin

## Description

This [Piwik](http://piwik.org) Plugin avoids regular users choosing date ranges as their default setting trying to save server resources,
then removes custom range selection from the calendar.

Each time users asks for ranged date reports, Piwik builds it on the fly during user's request.
This slows down the server when you have a big amount of visits and a large number of tracked websites.
This action is resource intensive so when it happens, live tracking may become slow or inaccurate.

Installing this plugin you remove choices in the field _"Report date to load by default"_ in _User Settings page_ for all regular users.
Superadmin users setting page remains untouched and adminstrators will see only a notification about plugin's behavior.

Since version 1.1.0 regular users can't select any more a custom range in the calendar but Superadmins still can build reports.

This plugin is translated in: English, Italian and French (just send a pull request to include your favourite language, see _Can I contribute_ f.a.q.)

## Installation

Please, read official [Piwik's documentation](http://piwik.org/faq/plugins/#faq_21) about it.

## FAQ

__I would like to see a demonstration...__
Just take a look at _screenshots_ directory.

__Is there any user interface configuration?__
No, any. You don't have to configure things, only to activate or deactivate the plugin.

__Can I donor to you?__
No, we can't accept donations because we're a Government Organization. Our donation links official Piwik project, simply help them to help us.

__Can I contribute on development?__
For sure! Just send a [pull request on Github](https://github.com/RegioneER/RerNewSite/issues)!

## Changelog

### v1.0.0

Repository configuration

### v1.0.1

First release and Marketplace integration

### v1.0.2

User Manager screen shot and better readme documentation

### v1.1.0

Custom date range selection is disabled in the calendar only for regular users. A shorts jQuery snippet hides radio input and submit button.

Regular users who chose a range date as their default are now forced to _yesterday_ report just visiting the index page with a warning notification.

### v1.1.1

New French translation by [gaumondp](https://github.com/gaumondp)

## License

[GPL v3](http://www.gnu.org/licenses/gpl-3.0-standalone.html) or later

## Support

Any feedback is welcome at the plugin's issues center on Github.
[https://github.com/RegioneER/RerUserDates/issues](https://github.com/RegioneER/RerUserDates/issues)
