<?php

PhangoVar::$model['shopindex_image']=new Webmodel('shopindex_image');

PhangoVar::$model['shopindex_image']->set_component('image', 'ImageField', array('image', PhangoVar::$base_path.'/modules/shopindex/media/images/carousel/', get_base_url_media('shopindex', 'images/carousel'), '', $thumb=0), $required=1);

PhangoVar::$model['shopindex_image']->set_component('title', 'CharField', array(255), 1);

PhangoVar::$model['shopindex_image']->set_component('description', 'TextHTMLField', array(), 1);

PhangoVar::$model['shopindex_image']->set_component('position', 'IntegerField', array(), 0);

PhangoVar::$model['shopindex_config']=new Webmodel('shopindex_config');

PhangoVar::$model['shopindex_config']->set_component('num_news', 'IntegerField', array(11), 1);

?>