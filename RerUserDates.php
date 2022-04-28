<?php

namespace Piwik\Plugins\RerUserDates;

use Exception;
use Piwik\Common;
use Piwik\Container\StaticContainer;
use Piwik\Piwik;
use Piwik\Plugin;
use Piwik\Notification;
use Psr\Log\LoggerInterface;

/**
 */
class RerUserDates extends Plugin
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    protected $usersManagerApi;

    public function __construct($pluginName = false)
    {
        parent::__construct($pluginName);
        $this->logger = StaticContainer::get('Psr\Log\LoggerInterface');
        $this->usersManagerApi = StaticContainer::get('Piwik\Plugins\UsersManager\API');
    }

    public function registerEvents()
    {
        $this->logger->debug('FN: {fn}', ['fn' => __FUNCTION__]);

        return array(
//            'AssetManager.getJavaScriptFiles'      => 'getJsFiles',
            'AssetManager.getStylesheetFiles'      => 'getCssFiles',
            'UsersManager.getDefaultDates'         => 'noRangedDates',
            'Controller.UsersManager.userSettings' => 'userSettingsNotification',
            'Controller.CoreHome.index'            => 'checkDefaultReportDate',
            'Controller.MultiSites.index'          => 'checkDefaultReportDate',
        );
    }

    public function getJsFiles(&$asset)
    {
        $this->logger->debug('FN: {fn}', ['fn' => __FUNCTION__]);
        $asset[] = 'plugins/RerUserDates/javascripts/RerUserDates.js';
    }

    public function getCssFiles(&$asset)
    {
        $this->logger->debug('FN: {fn}', ['fn' => __FUNCTION__]);
        $asset[] = 'plugins/RerUserDates/stylesheets/RerUserDates.less';
    }

    /**
     * Modifies Default dates UserSettings form
     *
     * @param $dates
     * @return array
     */
    public function noRangedDates(&$dates)
    {
        $this->logger->debug('FN: {fn}', ['fn' => __FUNCTION__]);

        Piwik::checkUserIsNotAnonymous();
        $rerSystemSettings = new SystemSettings;

        if (true === $rerSystemSettings->profiles->getValue() && false === $this->isSuperuser()) {
            $dates = array(
                'today'     => Piwik::translate('General_Today'),
                'yesterday' => Piwik::translate('General_Yesterday'),
                'week'      => Piwik::translate('General_CurrentWeek'),
                'month'     => Piwik::translate('General_CurrentMonth'),
                'year'      => Piwik::translate('General_CurrentYear'),
            );
        }
    }

    /**
     * Notify plugin's behaviour only to Super admins
     */
    public function userSettingsNotification()
    { 
        $this->logger->debug('FN: {fn}', ['fn' => __FUNCTION__]);

        Piwik::checkUserIsNotAnonymous();
        $rerSystemSettings = new SystemSettings;

        if (true === $rerSystemSettings->profiles->getValue() && true === $this->isSuperuser()) {
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
        $this->logger->debug('FN: {fn}', ['fn' => __FUNCTION__]);

        try {
            $userLogin = Piwik::getCurrentUserLogin();
            $this->logger->debug('USERLOGIN: {u}', ['u' => $userLogin]);
        } catch (Exception $e) {
            $this->logger->debug('USERLOGIN EXC: {u}', ['u' => $userLogin]);
            $e->getMessage();
        }

        try {
            $user = $this->usersManagerApi->getUser($userLogin);
            $this->logger->debug('USERDATA: {u}', ['u' => $user]);    
        } catch (Exception $e) {
            $this->logger->debug('USERDATA EXC: {u}', ['u' => $user]);    
            $e->getMessage();
        }

        if (true == $user['superuser_access']) {

            return true;
        }

        return false;
    }

    /**
     * Override for unwanted custom range selections setting to yesterday/day period with warning notification
     */
    public function checkDefaultReportDate()
    {
        $this->logger->debug('FN: {fn}', ['fn' => __FUNCTION__]);

        Piwik::checkUserIsNotAnonymous();

        $rerSystemSettings = new SystemSettings;

        if (true === $rerSystemSettings->profiles->getValue() && false === $this->isSuperuser()) {
            $userDates = $this->usersManagerApi->getUserPreference(
                $this->usersManagerApi::PREFERENCE_DEFAULT_REPORT_DATE
            );
            $userReport = $this->usersManagerApi->getUserPreference(
                $this->usersManagerApi::PREFERENCE_DEFAULT_REPORT
            );

            if (preg_match('/^[prev|last].+/', $userDates)) {
                $this->usersManagerApi->setUserPreference(
                    $this->usersManagerApi::PREFERENCE_DEFAULT_REPORT_DATE,
                    Piwik::getCurrentUserLogin(),
                    'yesterday'
                );

                $notification = new Notification(Piwik::translate('RerUserDates_DefaultDateMessage'));
                $notification->context = Notification::CONTEXT_WARNING;
                Notification\Manager::notify('RerUserDates_DefaultDateMessage', $notification);

                $period = Common::getRequestVar('period');
                if ('range' == $period) {
                    Piwik::redirectToModule($userReport,'index', array('period' => 'day', 'date' => 'yesterday'));
                }
            }
        }
    }

}
