/*!
 * Piwik - Web Analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

(function (require, $) {
    var ajaxHelper = require('ajaxHelper');
    var ajax = new ajaxHelper();
    ajax.setTimeout(5000);
    ajax.setUrl("index.php?module=API&method=RerUserDates.getSettingsCalendars&format=JSON");
    ajax.setCallback(function (response) {
        if (true == response.value)
        {
            if (true == response.value && false == piwik.hasSuperUserAccess)
            {
                $('#otherPeriods').find('p:last-of-type').remove();
            }
        }
    });
    ajax.send();
})(require, jQuery);
