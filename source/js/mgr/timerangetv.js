var timerangetv = function (config) {
    config = config || {};
    timerangetv.superclass.constructor.call(this, config);
};

Ext.extend(timerangetv, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, jquery: {}, form: {}
});
Ext.reg('timerangetv', timerangetv);

TimerangeTV = new timerangetv();

