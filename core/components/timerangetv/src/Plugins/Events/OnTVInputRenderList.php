<?php
/**
 * @package timerangetv
 * @subpackage plugin
 */

namespace TreehillStudio\TimerangeTV\Plugins\Events;

use TreehillStudio\TimerangeTV\Plugins\Plugin;

class OnTVInputRenderList extends Plugin
{
    public function process()
    {
        $this->modx->event->output($this->timerangetv->getOption('corePath') . 'elements/tv/input/');
    }
}
