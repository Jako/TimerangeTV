<?php
/**
 * TimerangeTV
 *
 * Copyright 2012-2019 by Bert Oost <bert@oostdesign.nl>
 * Copyright 2019-2022 by Thomas Jakobi <office@treehillstudio.com>
 *
 * @package timerangetv
 * @subpackage classfile
 */

namespace TreehillStudio\TimerangeTV;

use modX;

/**
 * Class TimerangeTV
 */
class TimerangeTV
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public $modx;

    /**
     * The namespace
     * @var string $namespace
     */
    public $namespace = 'timerangetv';

    /**
     * The package name
     * @var string $packageName
     */
    public $packageName = 'TimerangeTV';

    /**
     * The version
     * @var string $version
     */
    public $version = '1.2.5';

    /**
     * The class options
     * @var array $options
     */
    public $options = [];

    /**
     * TimerangeTV constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    public function __construct(modX &$modx, $options = [])
    {
        $this->modx =& $modx;

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/' . $this->namespace . '/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/' . $this->namespace . '/');
        $modxversion = $this->modx->getVersionData();

        // Load some default paths for easier management
        $this->options = array_merge([
            'namespace' => $this->namespace,
            'version' => $this->version,
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'vendorPath' => $corePath . 'vendor/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'pagesPath' => $corePath . 'elements/pages/',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'pluginsPath' => $corePath . 'elements/plugins/',
            'controllersPath' => $corePath . 'controllers/',
            'processorsPath' => $corePath . 'processors/',
            'templatesPath' => $corePath . 'templates/',
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $assetsUrl . 'connector.php'
        ], $options);

        // Add default options
        $this->options = array_merge($this->options, [
            'debug' => (bool)$this->modx->getOption($this->namespace . '.debug', null, '0') == 1,
            'modxversion' => $modxversion['version']
        ]);

        $lexicon = $this->modx->getService('lexicon', 'modLexicon');
        $lexicon->load($this->namespace . ':default');
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = [], $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("$this->namespace.$key", $this->modx->config)) {
                $option = $this->modx->getOption("$this->namespace.$key");
            }
        }
        return $option;
    }

    /**
     * Register javascripts in the controller
     */
    public function includeScriptAssets()
    {
        $assetsUrl = $this->getOption('assetsUrl');
        $jsUrl = $this->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';

        if ($this->getOption('debug') && $assetsUrl != MODX_ASSETS_URL . 'components/timerangetv/') {
            $this->modx->controller->addJavascript($jsSourceUrl . 'timerangetv.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'timerangetv.templatevar.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'timerangetv.renderer.js?v=v' . $this->version);
            $this->modx->controller->addCss($cssSourceUrl . 'timerangetv.css?v=v' . $this->version);
        } else {
            $this->modx->controller->addJavascript($jsUrl . 'timerangetv.min.js?v=v' . $this->version);
            $this->modx->controller->addCss($cssUrl . 'timerangetv.min.css?v=v' . $this->version);
        }
        $this->modx->controller->addHtml('<script type="text/javascript">' .
            'TimerangeTV.config = ' . json_encode($this->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';' .
            '</script>');
    }
}
