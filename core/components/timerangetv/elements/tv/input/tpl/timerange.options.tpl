<script type="text/javascript">
    // <![CDATA[{literal}
    var params = {
        {/literal}{foreach from=$params key=k item=v name='p'}
        '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last}, {/if}
        {/foreach}{literal}
    };
    var oc = {
        change: {
            fn: function () {
                Ext.getCmp('modx-panel-tv').markDirty();
            }, scope: this
        }
    };
    MODx.load({
        xtype: 'panel',
        layout: 'form',
        applyTo: 'modx-input-props',
        cls: 'daterangetv-props',
        border: false,
        labelAlign: 'top',
        listeners: {
            afterrender: function (component) {
                var tvTabId = (TimerangeTV.config.modxversion === '2') ? 'modx-tv-tabs' : 'modx-tv-editor-tabs';
                Ext.getCmp('modx-panel-tv-input-properties').addListener('resize', function () {
                    component.setWidth(Ext.getCmp('modx-input-props').getWidth()).doLayout();
                });
                Ext.getCmp(tvTabId).addListener('tabchange', function () {
                    component.setWidth(Ext.getCmp('modx-input-props').getWidth()).doLayout();
                });
            },
        },
        items: [{
            xtype: 'combo-boolean',
            fieldLabel: _('required'),
            description: MODx.expandHelp ? '' : _('required_desc'),
            name: 'inopt_allowBlank',
            hiddenName: 'inopt_allowBlank',
            id: 'inopt_allowBlank{/literal}{$tv}{literal}',
            value: !(params['allowBlank'] === 0 || params['allowBlank'] === 'false'),
            anchor: '100%',
            listeners: oc
        }, {
            xtype: MODx.expandHelp ? 'label' : 'hidden',
            forId: 'inopt_allowBlank{/literal}{$tv}{literal}',
            html: _('required_desc'),
            cls: 'desc-under'
        }, {
            layout: 'column',
            items: [{
                columnWidth: .5,
                layout: 'form',
                labelAlign: 'top',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('timerangetv.time_increment'),
                    description: MODx.expandHelp ? '' : _('timerangetv.time_increment_desc'),
                    name: 'inopt_timeIncrement',
                    id: 'inopt_timeIncrement{/literal}{$tv}{literal}',
                    value: params['timeIncrement'] || '60',
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'inopt_timeIncrement{/literal}{$tv}{literal}',
                    html: _('timerangetv.time_increment_desc'),
                    cls: 'desc-under'
                }, {
                    xtype: 'textfield',
                    fieldLabel: _('timerangetv.min_value'),
                    description: MODx.expandHelp ? '' : _('timerangetv.min_value_desc'),
                    name: 'inopt_minValue',
                    id: 'inopt_minValue{/literal}{$tv}{literal}',
                    value: params['minValue'] || '00:00',
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'inopt_minValue{/literal}{$tv}{literal}',
                    html: _('timerangetv.min_value_desc'),
                    cls: 'desc-under'
                }]
            }, {
                columnWidth: .5,
                layout: 'form',
                labelAlign: 'top',
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('timerangetv.time_format'),
                    description: MODx.expandHelp ? '' : _('timerangetv.time_format_desc'),
                    name: 'inopt_timeFormat',
                    id: 'inopt_timeFormat{/literal}{$tv}{literal}',
                    value: params['timeFormat'] || MODx.config.manager_time_format,
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'inopt_timeFormat{/literal}{$tv}{literal}',
                    html: _('timerangetv.time_format_desc'),
                    cls: 'desc-under'
                }, {
                    xtype: 'textfield',
                    fieldLabel: _('timerangetv.max_value'),
                    description: MODx.expandHelp ? '' : _('timerangetv.max_value_desc'),
                    name: 'inopt_maxValue',
                    id: 'inopt_maxValue{/literal}{$tv}{literal}',
                    value: params['maxValue'] || '23:59',
                    anchor: '100%',
                    listeners: oc
                }, {
                    xtype: MODx.expandHelp ? 'label' : 'hidden',
                    forId: 'inopt_maxValue{/literal}{$tv}{literal}',
                    html: _('timerangetv.max_value_desc'),
                    cls: 'desc-under'
                }]
            }]
        }, {
            cls: "treehillstudio_about",
            html: '<img width="146" height="40" src="' + TimerangeTV.config.assetsUrl + 'img/treehill-studio-small.png"' + ' srcset="' + TimerangeTV.config.assetsUrl + 'img/treehill-studio-small@2x.png 2x" alt="Treehill Studio">',
            listeners: {
                afterrender: function (component) {
                    component.getEl().select('img').on('click', function () {
                        var msg = '<span style="display: inline-block; text-align: center">&copy; 2012-2019 by <a href="https://oostdesign.com/" target="_blank">OostDesign</a><br>' +
                            '<img src="' + TimerangeTV.config.assetsUrl + 'img/treehill-studio.png" srcset="' + TimerangeTV.config.assetsUrl + 'img/treehill-studio@2x.png 2x" alt="Treehill Studio" style="margin-top: 10px"><br>' +
                            '&copy; 2019-2022 by <a href="https://treehillstudio.com" target="_blank">treehillstudio.com</a></span>';
                        Ext.Msg.show({
                            title: _('timerangetv') + ' ' + TimerangeTV.config.version,
                            msg: msg,
                            buttons: Ext.Msg.OK,
                            cls: 'treehillstudio_window',
                            width: 358
                        });
                    });
                }
            }
        }]
    });
    MODx.helpUrl = 'https://jako.github.io/TimerangeTV/usage/';
    // ]]>
</script>
{/literal}
