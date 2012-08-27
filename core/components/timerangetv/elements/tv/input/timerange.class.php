<?php

class TimerangeInputRender extends modTemplateVarInputRender {
    public function getTemplate() {
		$corePath = $this->modx->getOption('timerangetv.core_path',null,$this->modx->getOption('core_path').'components/timerangetv/');
        return $corePath.'templates/tv/input/timerange.tpl';
    }
    public function process($value,array $params = array()) {
		$this->modx->lexicon->load('tv_widget');
		$this->modx->lexicon->load('timerangetv:tvrenders');
		
		/*$test = ((strpos($value, '||')) ? true : false);
		if($test !== false) {
			$this->set('processedValue', array_pop(explode('||', $value)));
			$this->set('value', array_shift(explode('||', $value)));
		}*/
		
		/* fetch only the tv lexicon */
		$langs = $this->modx->lexicon->fetch();
		foreach($langs as $k => $v) {
			if(strpos($k, 'timerangetv.') !== false) {
				$k = str_replace('timerangetv.', '', $k);
				$k = str_replace('.', '_', $k);
			}
			$this->setPlaceholder('lang_'.$k, $v);
		}
		
		$this->setPlaceholder('params', $params);
    }
}

return 'TimerangeInputRender';

?>