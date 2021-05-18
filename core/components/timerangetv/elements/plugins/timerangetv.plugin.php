<?php
/**
 * Timerange TV Runtime Hooks
 *
 * @package timerangetv
 * @subpackage plugin
 *
 * @event OnManagerPageBeforeRender
 * @event OnTVInputRenderList
 * @event OnTVInputPropertiesList
 * @event OnDocFormRender
 *
 * @var modX $modx
 */

$eventName = $modx->event->name;

$corePath = $modx->getOption('timerangetv.core_path', null, $modx->getOption('core_path') . 'components/timerangetv/');
/** @var TimerangeTV $timerangetv */
$timerangetv = $modx->getService('timerangetv', 'TimerangeTV', $corePath . 'model/timerangetv/', array(
    'core_path' => $corePath
));

switch ($eventName) {
    case 'OnManagerPageBeforeRender':
        $modx->controller->addLexiconTopic('timerangetv:default');
        $timerangetv->includeScriptAssets();
        break;
    case 'OnTVInputRenderList':
        $modx->event->output($corePath . 'elements/tv/input/');
        break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($corePath . 'elements/tv/input/options/');
        break;
    case 'OnDocFormRender':
        $timerangetv->includeScriptAssets();
        break;
};
