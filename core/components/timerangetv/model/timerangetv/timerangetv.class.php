<?php

class TimerangeTV
{
	public $modx;
	public $config = array();
	
	function __construct(modX &$modx,array $config = array()) {
		$this->modx =& $modx;
 
		$basePath = $this->modx->getOption('timerangetv.core_path',$config,$this->modx->getOption('core_path').'components/timerangetv/');
		$assetsUrl = $this->modx->getOption('timerangetv.assets_url',$config,$this->modx->getOption('assets_url').'components/timerangetv/');
		$this->config = array_merge(array(
			'basePath' => $basePath,
			'corePath' => $basePath,
			'modelPath' => $basePath.'model/',
			'processorsPath' => $basePath.'processors/',
			'templatesPath' => $basePath.'templates/',
			'chunksPath' => $basePath.'elements/chunks/',
			'jsUrl' => $assetsUrl.'js/',
			'cssUrl' => $assetsUrl.'css/',
			'assetsUrl' => $assetsUrl,
			'connectorUrl' => $assetsUrl.'connector.php',
		),$config);
	}
}

?>