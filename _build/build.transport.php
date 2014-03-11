<?php
/**
 * selfLink build script
 *
 * @package selflink
 * @subpackage build
 */
$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

define('PKG_NAME', 'TimerangeTV');
define('PKG_NAME_LOWER', strtolower(PKG_NAME));
define('PKG_VERSION', '1.1.0');
define('PKG_RELEASE', 'pl');

/* override with your own defines here (see build.config.sample.php) */
require_once dirname(__FILE__) . '/build.config.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

$root = dirname(dirname(__FILE__)).'/';
$sources = array(
    'root' => $root,
    'build' => $root.'_build/',
    'resolvers' => $root.'_build/resolvers/',
    'data' => $root.'_build/data/',
	'permissions' => $root.'_build/data/permissions/',
    'chunks' => MODX_CORE_PATH.'components/'.PKG_NAME_LOWER.'/elements/chunks/',
    'snippets' => MODX_CORE_PATH.'components/'.PKG_NAME_LOWER.'/elements/snippets/',
    'lexicon' => MODX_CORE_PATH.'components/'.PKG_NAME_LOWER.'/lexicon/',
    'docs' => MODX_CORE_PATH.'components/'.PKG_NAME_LOWER.'/docs/',
    'source_assets' => MODX_ASSETS_PATH.'components/'.PKG_NAME_LOWER,
    'source_core' => MODX_CORE_PATH.'components/'.PKG_NAME_LOWER,
);
unset($root);

$modx= new modX();
$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');
$modx->loadClass('transport.modPackageBuilder','',false, true);

$builder = new modPackageBuilder($modx);
$builder->createPackage(PKG_NAME_LOWER,PKG_VERSION,PKG_RELEASE);
$builder->registerNamespace(PKG_NAME_LOWER,false,true,'{core_path}components/'.PKG_NAME_LOWER.'/');

/* create category */
$category= $modx->newObject('modCategory');
$category->set('id', 1);
$category->set('category', PKG_NAME);

/* add plugins */
$modx->log(modX::LOG_LEVEL_INFO, 'Packaging in plugins...');
$plugins = include $sources['data'].'transport.plugins.php';
if (empty($plugins)) $modx->log(modX::LOG_LEVEL_ERROR, 'Could not package in plugins.');
if (is_array($plugins)) {
	$category->addMany($plugins);
}

$attr = array(xPDOTransport::UNIQUE_KEY => 'category',
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
	xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array(
		'Plugins' => array(
			xPDOTransport::PRESERVE_KEYS => false,
			xPDOTransport::UPDATE_OBJECT => true,
			xPDOTransport::UNIQUE_KEY => 'name'
		)
	)
);
$vehicle = $builder->createVehicle($category,$attr);

$modx->log(modX::LOG_LEVEL_INFO, 'Packaging in core and assets files...');
$vehicle->resolve('file',array(
	'source' => $sources['source_core'],
	'target' => "return MODX_CORE_PATH . 'components/';",
));
/* No assets yet
$vehicle->resolve('file',array(
	'source' => $sources['source_assets'],
	'target' => "return MODX_ASSETS_PATH . 'components/';",
));*/
$vehicle->resolve('php', array(
    'source' => $sources['resolvers'] . 'plugins.resolve.php',
));
$builder->putVehicle($vehicle);

/* now pack in the license file, readme and setup options */
$modx->log(modX::LOG_LEVEL_INFO, 'Adding package attributes and setup options...');
$builder->setPackageAttributes(array(
    'license' => file_get_contents($sources['docs'] . 'license.txt'),
    'readme' => file_get_contents($sources['docs'] . 'readme.txt'),
    'changelog' => file_get_contents($sources['docs'] . 'changelog.txt'),
));

/* zip up package */
$modx->log(modX::LOG_LEVEL_INFO, 'Packing up transport package zip...');
$builder->pack();

$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tend = $mtime;
$totalTime = ($tend - $tstart);
$totalTime = sprintf("%2.4f s", $totalTime);

$modx->log(modX::LOG_LEVEL_INFO, "\nPackage Built.\nExecution time: {$totalTime}\n");