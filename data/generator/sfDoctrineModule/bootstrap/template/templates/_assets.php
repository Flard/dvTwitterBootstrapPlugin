<?php if (isset($this->params['css']) && ($this->params['css'] !== false)): ?> 
[?php use_stylesheet('<?php echo $this->params['css'] ?>', 'first') ?] 
<?php elseif(!isset($this->params['css'])): ?> 
[?php use_stylesheet('<?php echo sfConfig::get('sf_web_dir').'/dvTwitterBootstrapPlugin/admin.css' ?>', 'first') ?]
<?php endif; ?>