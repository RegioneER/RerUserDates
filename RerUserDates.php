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
use Piwik\Plugin;
use Piwik\Notification;
use Piwik\Plugins\UsersManager\API as APIUsersManager;

/**
 */
class RerUserDates extends Plugin
{
    /**
     * @see Piwik\Plugin::getListHooksRegistered
     */
    public function getListHooksRegistered()
    {
        return array(
            'UsersManager.getDefaultDates'         => 'noRangedDates',
            'Controller.UsersManager.userSettings' => 'userSettingsNotification',
        );
    }

    /**
     * Modifies Default dates UserSettings form
     *
     * @param $dates
     * @return array
     */
    public function noRangedDates(&$dates)
    {
        Piwik::checkUserIsNotAnonymous();

        if (false == $this->isSuperuser()) {
            $dates = array(
                'today'     => Piwik::translate('General_Today'),
                'yesterday' => Piwik::translate('General_Yesterday'),
                'week'      => Piwik::translate('General_CurrentWeek'),
                'month'     => Piwik::translate('General_CurrentMonth'),
                'year'      => Piwik::translate('General_CurrentYear'),
            );
        }

        return $dates;
    }

    /**
     * Notify plugin's behaviour only to Superadmins
     */
    public function userSettingsNotification()
    {
        Piwik::checkUserIsNotAnonymous();

        if (true == $this->isSuperuser()) {
            $notification = new Notification(Piwik::translate('RerUserDates_SuperuserMessage'));
            Notification\Manager::notify('RerUserDates_SuperuserMessage', $notification);
        }
    }

    /**
     * Checks if the current user has Superadmin privilege
     *
     * @return bool
     */
    protected function isSuperuser()
    {
        $userLogin = Piwik::getCurrentUserLogin();
        $user = APIUsersManager::getInstance()->getUser($userLogin);

        if (true == $user['superuser_access']) {
            return true;
        }

        return false;
    }

}
