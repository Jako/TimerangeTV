<?php

function getPluginContent($filename) {
    $o = file_get_contents($filename);
    $o = trim(str_replace(array('<?php','?>'), '', $o));
    return $o;
}

$list = array(
	'TimerangeTV' => 'Will create a timerange TV input type',
);

$plugins = array();

$i = 1;
foreach($list as $plugin => $description) {

	$plugins[$i]= $modx->newObject('modplugin');
	$plugins[$i]->fromArray(array(
		'id' => 1,
		'name' => $plugin,
		'description' => $description,
		'plugincode' => getPluginContent($sources['plugins'].strtolower($plugin).'.plugin.php'),
	), '', true, true);
	
	$i++;
}

return $plugins;

?>