<?php
/**
 * Input Properties for Timerange TV
 *
 * @package timerangetv
 * @subpackage input properties
 *
 * @var \modX $modx
 */

$corePath = $modx->getOption('timerangetv.core_path', null, $modx->getOption('core_path') . 'components/timerangetv/');

return $modx->smarty->fetch($corePath . 'elements/tv/input/tpl/timerange.options.tpl');
