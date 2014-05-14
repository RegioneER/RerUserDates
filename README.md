# Piwik RerUserDates Plugin

## Description

This [Piwik](http://piwik.org) Plugin avoids regular users choosing date ranges as their default setting trying to save server resources.

Each time users asks for ranged date reports, Piwik builds it on the fly during user's request.
This slows down the server when you have a big amount of visits and a large number of tracked websites.
This action is resource intensive so when it happens, live tracking may become slow or inaccurate.

Installing this plugin you remove choices in the field _"Report date to load by default"_ in _User Settings page_ for all regular users.
Superadmin users setting page remains untouched and adminstrators will see only a notification about this plugin behavior.

## Installation

Please, read official [Piwik's documentation](http://piwik.org/faq/plugins/#faq_21) about it.

## FAQ

__I would like to see a demonstration...__
Just take a look at _screenshots_ directory.

__Is there any user interface configuration?__
No, any. You don't have to configure things, only to activate or deactivate the plugin.

__Can I contribute on development?__
For sure! Just send a [pull request on Github](https://github.com/RegioneER/RerNewSite/issues)!

## Changelog

* 1.0.0 Repository configuration
* __1.0.1__ First release and Marketplace integration

## License

[GPL v3](http://www.gnu.org/licenses/gpl-3.0-standalone.html) or later

## Support

Any feedback is welcome at the plugin's issues center on Github.
[https://github.com/RegioneER/RerUserDates/issues](https://github.com/RegioneER/RerUserDates/issues)
