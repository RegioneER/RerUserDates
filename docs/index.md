## Documentation 

### Installation

You can easily install the plugin by Matomo's Marketplace web interface.

Or please, read official [Matomo's documentation](https://matomo.org/faq/plugins/#faq_21) about plugins installation.

### Translations

[![Translation status](https://hosted.weblate.org/widgets/matomo/-/communityplugin-reruserdates/horizontal-auto.svg)](https://hosted.weblate.org/engage/matomo/)

### Changelog

#### v4.x

- Adding Weblate translations and Weblate repository syncronization.
- Bumping mayor version to match Matomo's.
- Refactoring PHP/DI
- Refactoring UI modification, by css not js

#### v3.x

Since this version, this plugin is Matomo 4 compatible

- Project's refactoring for Matomo 4.x-dev environment
- AGID's Publiccode inclusion for [«Catalogo del Riuso»](https://developers.italia.it/it/search?type=reuse_software) ([«Reuse Catalog» in english](https://developers.italia.it/en/search?type=reuse_software)) inclusion

#### v.2.x

Adding Matomo 3.x plugin compatibility, Piwik 2.x is deprecated and no more supported. Please download v.1.x for older versions.

#### v.1.x

- Settings environment breaks compatibility with Matomo versions < 2.8.0, thanks to @ThaDafinser.
- New plugin settings user interface for super admins, some better improvement and few bugs solved.
- Solved a regression due to a lack of Settings Feature in Matomo's versions below 2.4.0
- Merged French translation
- Fixed Matomo compatibility with 2.10 from 2.7 by @ThaDafinser in PR #6
- Custom date range selection is disabled in the calendar only for regular users. A shorts jQuery snippet hides radio input and submit button.
- Regular users who chose a range date as their default are now forced to _yesterday_ report just visiting the index page with a warning notification.
- New French translation by @gaumondp
- First release and Marketplace integration
- User Manager screen shot and better readme documentation
