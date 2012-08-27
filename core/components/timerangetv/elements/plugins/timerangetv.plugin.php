<?php
/**
 * TimerangeTV
 * Will create a timerange TV input type
 * 
 * @package timerangetv
 * @author Bert Oost at OostDesign.nl <bert@oostdesign.nl>
 */
$trtv = $modx->getService('timerangetv','TimerangeTV',$modx->getOption('timerangetv.core_path',null,$modx->getOption('core_path').'components/timerangetv/').'model/timerangetv/',$scriptProperties);
if (!($trtv instanceof TimerangeTV)) return '';

$modx->lexicon->load('timerangetv:tvrenders');

$corePath = $modx->getOption('timerangetv.core_path',null,$modx->getOption('core_path').'components/timerangetv/');
switch($modx->event->name) {
    case 'OnTVInputRenderList':
        $modx->event->output($trtv->config['corePath'].'elements/tv/input/');
    break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($trtv->config['corePath'].'elements/tv/properties/input/');
    break;
}

?>