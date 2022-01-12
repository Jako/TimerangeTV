<?php
/**
 * Abstract plugin
 *
 * @package timerangetv
 * @subpackage plugin
 */

namespace TreehillStudio\TimerangeTV\Plugins;

use modX;
use TreehillStudio\TimerangeTV\TimerangeTV;

/**
 * Class Plugin
 */
abstract class Plugin
{
    /** @var modX $modx */
    protected $modx;
    /** @var TimerangeTV $timerangetv */
    protected $timerangetv;
    /** @var array $scriptProperties */
    protected $scriptProperties;

    /**
     * Plugin constructor.
     *
     * @param $modx
     * @param $scriptProperties
     */
    public function __construct($modx, &$scriptProperties)
    {
        $this->scriptProperties = &$scriptProperties;
        $this->modx =& $modx;
        $corePath = $this->modx->getOption('timerangetv.core_path', null, $this->modx->getOption('core_path') . 'components/timerangetv/');
        $this->timerangetv = $this->modx->getService('timerangetv', 'TimerangeTV', $corePath . 'model/timerangetv/', [
            'core_path' => $corePath
        ]);
    }

    /**
     * Run the plugin event.
     */
    public function run()
    {
        $init = $this->init();
        if ($init !== true) {
            return;
        }

        $this->process();
    }

    /**
     * Initialize the plugin event.
     *
     * @return bool
     */
    public function init()
    {
        return true;
    }

    /**
     * Process the plugin event code.
     *
     * @return mixed
     */
    abstract public function process();
}