<?php
/**
 * TimerangeTV Input Options Render
 *
 * @package timerangetv
 * @subpackage inputoptions_render
 */

/** @var modX $modx */
$corePath = $modx->getOption('timerangetv.core_path', null, $modx->getOption('core_path') . 'components/timerangetv/');

return $modx->smarty->fetch($corePath . 'elements/tv/input/tpl/timerange.options.tpl');
