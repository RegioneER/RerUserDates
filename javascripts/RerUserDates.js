/*!
 * Piwik - Web Analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

$(document).ready(function () {
    (function (require, $) {
        var ajaxHelper = require('ajaxHelper');
        var ajax = new ajaxHelper();
        ajax.setTimeout(5000);
        ajax.setUrl("index.php?module=API&method=UsersManager.hasSuperUserAccess&format=JSON");
        ajax.setCallback(function (response) {
            if (false == response.value) {
                $('.period-type label:last-of-type').hide();
                $('.period-type div:last-of-type').hide();
                $('#calendarRangeApply').hide();
            }
        });
        ajax.send();
    })(require, jQuery);

});
