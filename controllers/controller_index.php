<?php

class IndexSwitchClass {


	public function Index()
	{

		//global $user_data, $model, $ip, $lang, $config_data, $base_path, $base_url, $cookie_path, $arr_block, $prefix_key, $block_title, $block_content, $block_urls, $block_type, $block_id, $config_data, $text_url, $arr_cache_jscript, $arr_cache_css, $arr_cache_header;
		
		load_model('shopindex', 'shop');
		
		$header_js_pages='';
		
		$name_page=PhangoVar::$lang['common']['home'];
		
		$cont_index_page='';

		/*$arr_block='';

		$arr_block=select_view(array('serverever'));*/
		
		$arr_image=array();
		
		$arr_content=array();
		
		$arr_image=PhangoVar::$model['shopindex_image']->select_to_array('order by position ASC');
		
		//Obtain last producs.
		
		$arr_product=PhangoVar::$model['product']->select_to_array('order by date DESC limit 20');
		
		/*foreach($arr_product as $idproduct => $arr_product)
		{
		
			$arr_photo[$idproduct]='default_image.jpg';
		
		}*/
		
		$arr_id=array_keys($arr_product);
		
		foreach($arr_id as $idproduct)
		{
		
			$arr_photo[$idproduct]='default_image.jpg';
		
		}
		
		$query=PhangoVar::$model['image_product']->select('where idproduct IN (\''.implode("', '", $arr_id).'\') and principal=1', array('photo', 'idproduct'), true);

		while(list($photo, $idproduct)=webtsys_fetch_row($query))
		{

			$arr_photo[$idproduct]=$photo;

		}
		
		
		echo load_view(array($arr_image, $arr_product, $arr_photo), 'shopindex/shopindex');
		
		$cont_index_page.=ob_get_contents();

		ob_end_clean();
		
		echo load_view(array($name_page, $cont_index_page), 'home');

		//echo load_view(array($name_page, $cont_index_page, $block_title, $block_content, $block_urls, $block_type, $block_id, $config_data, $header_js_pages), $arr_block);

	}
	
}

?>
