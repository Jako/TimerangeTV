<?php
/**
 * @package timerangetv
 * @subpackage plugin
 */

namespace TreehillStudio\TimerangeTV\Plugins\Events;

use TreehillStudio\TimerangeTV\Plugins\Plugin;

class OnTVInputPropertiesList extends Plugin
{
    public function process()
    {
        $this->modx->event->output($this->timerangetv->getOption('corePath') . 'elements/tv/input/options/');
    }
}
