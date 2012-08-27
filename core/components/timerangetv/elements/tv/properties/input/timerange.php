<?php

$modx->lexicon->load('tv_widget','timerangetv:tvrenders');
$lang = $modx->lexicon->fetch('timerangetv.',true);

$modx->smarty->assign('timerangetv',$lang);

$corePath = $modx->getOption('timerangetv.core_path',null,$modx->getOption('core_path').'components/timerangetv/');
return $modx->smarty->fetch($corePath.'templates/tv/properties/input/timerange.tpl');

?>