<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\RerUserDates;

use Piwik\Piwik;
use Piwik\Settings\SystemSetting;
use Piwik\Version;

/**
 * Class Settings
 * @package Piwik\Plugins\RerUserDates
 */
class Settings extends \Piwik\Plugin\Settings
{
    /**
     * @var
     */
    public $profiles;

    /**
     * @var
     */
    public $calendars;

    /**
     *
     */
    protected function init()
    {
        $this->setIntroduction(Piwik::translate('RerUserDates_Settings'));
        if (version_compare(Version::VERSION, '2.4.0-b1', 'ge'))
        {
            $this->createProfileSettings();
            $this->createCalendarSettings();
        }
    }

    /**
     *
     */
    protected function createProfileSettings()
    {
        $this->profiles = new SystemSetting('profiles', Piwik::translate('RerUserDates_SettingsProfiles'));
        $this->profiles->readableByCurrentUser = true;
        $this->profiles->type = static::TYPE_BOOL;
        $this->profiles->uiControlType = static::CONTROL_CHECKBOX;
        $this->profiles->description = Piwik::translate('RerUserDates_SettingsProfilesDescription');
        $this->profiles->defaultValue = true;

        $this->addSetting($this->profiles);
    }

    /**
     *
     */
    protected function createCalendarSettings()
    {
        $this->calendars = new SystemSetting('calendars', Piwik::translate('RerUserDates_SettingsCalendars'));
        $this->calendars->readableByCurrentUser = true;
        $this->calendars->type = static::TYPE_BOOL;
        $this->calendars->uiControlType = static::CONTROL_CHECKBOX;
        $this->calendars->description = Piwik::translate('RerUserDates_SettingsCalendarsDescription');
        $this->calendars->defaultValue = false;

        $this->addSetting($this->calendars);
    }

} 
