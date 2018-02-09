<?php

namespace Piwik\Plugins\RerUserDates;

use Piwik\Piwik;
use Piwik\Settings\Setting;
use Piwik\Settings\FieldConfig;

/**
 * Defines Settings for RerUserDates.
 *
 * Usage like this:
 * $settings = new SystemSettings();
 * $settings->metric->getValue();
 * $settings->description->getValue();
 */
class SystemSettings extends \Piwik\Settings\Plugin\SystemSettings
{

    /** @var Setting */
    public $profiles;

    /** @var  Setting */
    public $calendars;

    protected function init()
    {
//        $this->setIntroduction(Piwik::translate('RerUserDates_Settings'));
        $this->profiles = $this->createProfileSettings();
        $this->calendars = $this->createCalendarSettings();
    }


    /**
     * @return \Piwik\Settings\Plugin\SystemSetting
     */
    private function createProfileSettings()
    {
        return $this->makeSetting('profiles',
            true, // default value
            FieldConfig::TYPE_BOOL,
            function (FieldConfig $field){
                $field->title = Piwik::translate('RerUserDates_SettingsProfiles');
                $field->description = Piwik::translate('RerUserDates_SettingsProfilesDescription');;
            });
    }

    /**
     * @return \Piwik\Settings\Plugin\SystemSetting
     */
    private function createCalendarSettings()
    {
        return $this->makeSetting('calendars',
            false, // default value
            FieldConfig::TYPE_BOOL,
            function (FieldConfig $field){
                $field->title = Piwik::translate('RerUserDates_SettingsCalendars');
                $field->description = Piwik::translate('RerUserDates_SettingsCalendarsDescription');;
                $field->uiControl = FieldConfig::UI_CONTROL_CHECKBOX;
            });
    }

}
