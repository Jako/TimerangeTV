<div id="tv-input-properties-form{$tv}"></div>
{literal}

<script type="text/javascript">
// <![CDATA[
var params = {
{/literal}{foreach from=$params key=k item=v name='p'}
 '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last},{/if}
{/foreach}{literal}
};
var oc = {'change':{fn:function(){Ext.getCmp('modx-panel-tv').markDirty();},scope:this}};

MODx.load({
    xtype: 'panel'
    ,layout: 'form'
    ,cls: 'form-with-labels'
    ,autoHeight: true
    ,border: false
    ,labelAlign: 'top'
    ,labelSeparator: ''
    ,items: [{
        xtype: 'combo-boolean'
        ,fieldLabel: _('required')
        ,description: MODx.expandHelp ? '' : _('required_desc')
        ,name: 'inopt_allowBlank'
        ,hiddenName: 'inopt_allowBlank'
        ,id: 'inopt_allowBlank{/literal}{$tv}{literal}'
        ,value: params['allowBlank'] == 0 || params['allowBlank'] == 'false' ? false : true
        ,width: 200
        ,listeners: oc
    },{
        xtype: MODx.expandHelp ? 'label' : 'hidden'
        ,forId: 'inopt_allowBlank{/literal}{$tv}{literal}'
        ,html: _('required_desc')
        ,cls: 'desc-under'
    },{
        xtype: 'textfield'
        ,fieldLabel: '{/literal}{$timerangetv.time_increment}{literal}'
		,description: '{/literal}{$timerangetv.time_increment_desc}{literal}'
        ,name: 'inopt_timeIncrement'
        ,id: 'inopt_timeIncrement{/literal}{$tv}{literal}'
        ,value: params['timeIncrement'] || '60'
        ,width: 200
        ,listeners: oc
    },{
        xtype: MODx.expandHelp ? 'label' : 'hidden'
        ,forId: 'inopt_timeIncrement{/literal}{$tv}{literal}'
        ,html: '{/literal}{$timerangetv.time_increment_desc}{literal}'
        ,cls: 'desc-under'
    },{
        xtype: 'textfield'
        ,fieldLabel: '{/literal}{$timerangetv.time_format}{literal}'
		,description: '{/literal}{$timerangetv.time_format_desc}{literal}'
        ,name: 'inopt_timeFormat'
        ,id: 'inopt_timeFormat{/literal}{$tv}{literal}'
        ,value: params['timeFormat'] || 'g:i A'
        ,width: 200
        ,listeners: oc
    },{
        xtype: MODx.expandHelp ? 'label' : 'hidden'
        ,forId: 'inopt_timeFormat{/literal}{$tv}{literal}'
        ,html: '{/literal}{$timerangetv.time_format_desc}{literal}'
        ,cls: 'desc-under'
    }]
    ,renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
});
// ]]>
</script>
{/literal}
