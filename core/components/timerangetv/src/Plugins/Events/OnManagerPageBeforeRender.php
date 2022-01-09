<?php
/**
 * @package timerangetv
 * @subpackage plugin
 */

namespace TreehillStudio\TimerangeTV\Plugins\Events;

use TreehillStudio\TimerangeTV\Plugins\Plugin;

class OnManagerPageBeforeRender extends Plugin
{
    public function process()
    {
        $this->modx->controller->addLexiconTopic('timerangetv:default');
        $this->timerangetv->includeScriptAssets();
    }
}
