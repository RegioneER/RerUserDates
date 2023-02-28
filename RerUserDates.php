<?php

namespace Piwik\Plugins\RerUserDates;

use Exception;
use Piwik\Url;
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
            'AssetManager.getStylesheetFiles'      => 'getCssFiles',
            'UsersManager.getDefaultDates'         => 'noRangedDates',
            'Controller.UsersManager.userSettings' => 'userSettingsNotification',
            'Controller.CoreHome.index'            => 'checkDefaultReportDate',
            'Controller.MultiSites.index'          => 'checkDefaultReportDate',
        );
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
            Piwik::checkUserHasSuperUserAccess();
            $this->logger->debug('FN: {fn} >> {mm}', ['fn' => __FUNCTION__, 'mm' => 'GOT SU']);

            return true;
        } catch (Exception $e) {
            $this->logger->debug('FN: {fn} >> {mm}', ['fn' => __FUNCTION__, 'mm' => 'NOT SU']);

            return false;
        }
        
        return false;
    }

    /**
     * Override for unwanted custom range selections setting to yesterday/day period with warning notification
     */
    public function checkDefaultReportDate(&$parameters)
    {
        $this->logger->debug('FN: {fn} params: {pp}', ['fn' => __FUNCTION__, 'pp' => $parameters]);

        Piwik::checkUserIsNotAnonymous();

        $rerSystemSettings = new SystemSettings;

        if (true === $rerSystemSettings->profiles->getValue() && false === $this->isSuperuser()) {
            $this->logger->debug('FN: {fn} >>> {mm}', ['fn' => __FUNCTION__, 'mm' => 'GOT TO WORK']);

            $userDates = $this->usersManagerApi->getUserPreference(
                $this->usersManagerApi::PREFERENCE_DEFAULT_REPORT_DATE
            );
            $this->logger->debug('FN: {fn} >>> date {mm}', ['fn' => __FUNCTION__, 'mm' => $userDates]);
            $userReport = $this->usersManagerApi->getUserPreference(
                $this->usersManagerApi::PREFERENCE_DEFAULT_REPORT
            );
            $this->logger->debug('FN: {fn} >>> report {mm}', ['fn' => __FUNCTION__, 'mm' => $userReport]);

            if (preg_match('/^(previous|last)\d{1,2}/', $userDates)) {
		        $this->logger->debug('FN: {fn} >>> {mm}', ['fn' => __FUNCTION__, 'mm' => 'pregmeccio']);
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
                    $this->logger->debug('FN: {fn} >>> {mm}', ['fn' => __FUNCTION__, 'mm' => 'GOT TO REDIRECT']);
                    //Piwik::redirectToModule($userReport,'index', array('period' => 'day', 'date' => 'yesterday'));
                }
            } 
        }

    	return;
    }

}