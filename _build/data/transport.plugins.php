<?php

if (! function_exists('getPluginContent')) {
    function getpluginContent($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<?php','',$o);
        $o = str_replace('?>','',$o);
        $o = trim($o);
        return $o;
    }
}

$plugins = array();

$plugins[1]= $modx->newObject('modPlugin');
$plugins[1]->fromArray(array(
    'id' => 1,
    'name' => 'TimerangeTV',
    'description' => 'Will create a timerange TV input type',
    'plugincode' => getPluginContent($sources['source_core'].'/elements/plugins/timerangetv.plugin.php'),
),'',true,true);

return $plugins;