<?php

$modx =& $object->xpdo;

$modx->log(xPDO::LOG_LEVEL_INFO, 'Assigning Events to Plugin');
switch($options[xPDOTransport::PACKAGE_ACTION]) {
	case xPDOTransport::ACTION_INSTALL:
		
		$plugin = 'TimerangeTV';
		$events = array('OnTVInputRenderList','OnTVInputPropertiesList');
		
		$pluginObj = $modx->getObject('modPlugin', array('name' => $plugin));
		if(!$pluginObj) $modx->log(xPDO::LOG_LEVEL_INFO, 'Cannot get object: '.$plugin);

        foreach($events as $eventName) {

            $exists = $modx->getObject('modPluginEvent', array('event' => $eventName, 'pluginid' => $pluginObj->get('id')));
            if(empty($exists)) {
                $intersect = $modx->newObject('modPluginEvent');
				$intersect->set('event', $eventName);
				$intersect->set('pluginid', $pluginObj->get('id'));
				$intersect->save();
            }
        }

	break;
}