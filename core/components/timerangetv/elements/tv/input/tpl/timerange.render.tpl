<input id="tv{$tv->id}" type="hidden" class="textfield"
       value="{$tv->value}" name="tv{$tv->id}"
       onblur="MODx.fireResourceFormChange();"/>
<div id="modx-timerange-tv{$tv->id}" class="timerangetv-panel-input"></div>

<script type="text/javascript">
    // <![CDATA[{literal}
    Ext.onReady(function () {
        MODx.load({{/literal}
            xtype: 'timerangetv-combo-timerangetv',
            tvId: '{$tv->id}',
            timeFormat: '{$params.timeFormat|default}' || MODx.config['manager_time_format'],
            timeIncrement: {$params.timeIncrement|default:'60'},
            minValue: '{$params.minValue|default:'00:00'}',
            maxValue: '{$params.maxValue|default:'23:59'}',
            allowBlank: {$params.allowBlank},
            timerangeStart: '{$timerange[0]|default}',
            timerangeEnd: '{$timerange[1]|default}',
            renderTo: 'modx-timerange-tv{$tv->id}'{literal}
        });
    });{/literal}
    // ]]>
</script>
