/**
 * Output Renderer for TimerangeTV
 *
 * @package timerangetv
 * @subpackage output renderer
 * @return {string}
 */

TimerangeTV.Renderer = function (value) {
    if (!value.length) {
        return '';
    }

    var data = value.split('||'),
        start = (data.length >= 1) ? new Date(data[0]) : false,
        end = (data.length >= 2) ? new Date(data[1]) : false,
        format = MODx.config['timerangetv.time_format'] || MODx.config['manager_time_format'],
        separator = MODx.config['timerangetv.separator'] || '&thinsp;-&thinsp;',
        result = '';

    if (start && start.getTime()) {
        if (end && end.getTime()) {
            if (start.getTime() !== end.getTime()) {
                result = Ext.util.Format.date(start, format) + separator + Ext.util.Format.date(end, format);
            } else {
                result = Ext.util.Format.date(start, format);
            }
        } else {
            result = Ext.util.Format.date(start, format);
        }
    }
    return result;
};
