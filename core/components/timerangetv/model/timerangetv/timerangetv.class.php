<?php
/**
 * Main Class for Timerange TV
 *
 * Copyright 2012-2019 by Bert Oost <bert@oostdesign.nl>
 * Copyright 2019 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package timerangetv
 * @subpackage classfile
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
     * The version
     * @var string $version
     */
    public $version = '1.2.0-pl2';

    /**
     * The class options
     * @var array $options
     */
    public $options = array();

    /**
     * TimerangeTV constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    function __construct(modX &$modx, $options = array())
    {
        $this->modx = &$modx;

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path') . 'components/timerangetv/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path') . 'components/timerangetv/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url') . 'components/timerangetv/');

        // Load some default paths for easier management
        $this->options = array_merge(array(
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
        ), $options);

        // set default options
        $this->options = array_merge($this->options, array());

        $this->modx->lexicon->load($this->namespace . ':default');
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
    public function getOption($key, $options = array(), $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
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

        if ($this->getOption('debug') && $this->getOption('assetsUrl') != MODX_ASSETS_URL . 'components/timerangetv/') {
            $this->modx->controller->addCss($cssSourceUrl . 'timerangetv.css?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'timerangetv.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'timerangetv.templatevar.js?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsSourceUrl . 'timerangetv.renderer.js?v=v' . $this->version);
        } else {
            $this->modx->controller->addCss($cssUrl . 'timerangetv.min.css?v=v' . $this->version);
            $this->modx->controller->addJavascript($jsUrl . 'timerangetv.min.js?v=v' . $this->version);
        }
        $this->modx->controller->addHtml('<script type="text/javascript">TimerangeTV.config = ' . json_encode($this->options, JSON_PRETTY_PRINT) . ';</script>');
    }
}
