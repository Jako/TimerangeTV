Ext.apply(Ext.form.VTypes, {
    timerange: function (val, field) {
        var time = field.parseDate(val);
        var formatted = time.format('Gi');
        if (!time) {
            return false;
        }
        var start = Ext.getCmp(field.startTimeField);
        var end = Ext.getCmp(field.endTimeField);
        if (start) {
            if (!start.maxValue || (formatted !== start.maxValue.format('Gi'))) {
                start.setMaxValue(time);
                start.validate();
            }
        }
        if (end) {
            // var test1 = time.getTime();
            // var test2 = end.minValue.getTime();
            if (!end.minValue || (formatted !== end.minValue.format('Gi'))) {
                end.setMinValue(time);
                end.validate();
            }
        }
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
    }
});

TimerangeTV.combo.TimerangeTV = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        xtype: 'panel',
        layout: 'column',
        autoHeight: true,
        border: false,
        width: 400,
        items: [{
            xtype: 'panel',
            columnWidth: .5,
            layout: 'form',
            labelAlign: 'top',
            border: false,
            items: [
                new Ext.form.TimeField({
                    fieldLabel: _('timerangetv.from'),
                    name: 'from' + config.tvId + '[]',
                    id: 'from' + config.tvId,
                    format: config.timeFormat,
                    increment: config.timeIncrement,
                    minValue: config.minValue,
                    maxValue: config.maxValue,
                    enableKeyEvents: true,
                    allowBlank: config.allowBlank,
                    value: config.timerangeStart,
                    msgTarget: 'under',
                    vtype: 'timerange',
                    labelStyle: 'padding-top:4px;',
                    endTimeField: 'to' + config.tvId, // id of the end time field
                    listeners: {
                        change: {
                            fn: this.timerangeOnChange,
                            scope: this
                        }
                    }
                })
            ]
        }, {
            xtype: 'panel',
            columnWidth: .5,
            layout: 'form',
            labelAlign: 'top',
            border: false,
            items: [
                new Ext.form.TimeField({
                    fieldLabel: _('timerangetv.to'),
                    name: 'to' + config.tvId + '[]',
                    id: 'to' + config.tvId,
                    format: config.timeFormat,
                    increment: config.timeIncrement,
                    minValue: config.minValue,
                    maxValue: config.maxValue,
                    enableKeyEvents: true,
                    allowBlank: true,
                    value: config.timerangeEnd,
                    msgTarget: 'under',
                    vtype: 'timerange',
                    labelStyle: 'padding-top:4px;',
                    startTimeField: 'from' + config.tvId, // id of the start time field
                    listeners: {
                        change: {
                            fn: this.timerangeOnChange,
                            scope: this
                        }
                    }
                })
            ]
        }]
    });
    TimerangeTV.combo.TimerangeTV.superclass.constructor.call(this, config);
};
Ext.extend(TimerangeTV.combo.TimerangeTV, MODx.Panel, {
    timerangeOnChange: function () {
        var values = {
            from: Ext.getCmp('from' + this.config.tvId, this.config.timeFormat).getValue(),
            to: Ext.getCmp('to' + this.config.tvId, this.config.timeFormat).getValue()
        };
        this.setTVValue(values);
    },
    setTVValue: function (values) {
        var oldFromToTime = this.getTVValue();
        var fromTime = '';
        var toTime = '';
        var fromToTime = '';
        if (values.from) {
            fromToTime = values.from + '||';
            if (values.to) {
                fromToTime = fromToTime + values.to;
            }
        }
        Ext.get('tv' + this.config.tvId).set({'value': fromToTime});
        if (oldFromToTime !== fromToTime) {
            MODx.fireResourceFormChange();
        }
    },
    getTVValue: function () {
        var fromToTime = Ext.get('tv' + this.config.tvId).getValue();
        return fromToTime;
    }
});
Ext.reg('timerangetv-combo-timerangetv', TimerangeTV.combo.TimerangeTV);
