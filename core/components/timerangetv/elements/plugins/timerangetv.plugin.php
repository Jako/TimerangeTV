<?php
/**
 * TimerangeTV Runtime Hooks
 *
 * @package timerangetv
 * @subpackage plugin
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$className = 'TreehillStudio\TimerangeTV\Plugins\Events\\' . $modx->event->name;

$corePath = $modx->getOption('timerangetv.core_path', null, $modx->getOption('core_path') . 'components/timerangetv/');
/** @var TimerangeTV $timerangetv */
$timerangetv = $modx->getService('timerangetv', 'TimerangeTV', $corePath . 'model/timerangetv/', [
    'core_path' => $corePath
]);

if ($timerangetv) {
    if (class_exists($className)) {
        $handler = new $className($modx, $scriptProperties);
        if (get_class($handler) == $className) {
            $handler->run();
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' could not be initialized!', '', 'TimerangeTV Plugin');
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' was not found!', '', 'TimerangeTV Plugin');
    }
}

return;
