<?php

function ShopIndexAdmin()
{

	//global $lang, $model, PhangoVar::$base_url;
	
	load_libraries(array('admin/generate_admin_class', 'utilities/menu_selected', 'forms/textareabb'));
	
	load_model('shopindex');
	
	settype($_GET['op'], 'integer');
	
	$arr_op=array();
	
	$arr_op[0]=array('link' =>set_admin_link('imagenes', array('op' => 0)), 'text' => 'Imágenes de carrusel');
	//$arr_op[1]=array('link' =>set_admin_link('secciones', array('op' => 1)), 'text' => 'Secciones');
	
	menu_selected($_GET['op'], $arr_op, $type=0);
	
	switch($_GET['op'])
	{
	
		default:
		
			PhangoVar::$model['shopindex_image']->create_form();
			
			PhangoVar::$model['shopindex_image']->set_enctype_binary();
			
			PhangoVar::$model['shopindex_image']->forms['description']->form='TextAreaBBForm';
		
			$admin=new GenerateAdminClass('shopindex_image');
	
			$admin->url_options=set_admin_link('shopindex', array('op' => 0));
			$admin->url_back=$admin->url_options;
	
			$admin->arr_fields=array('title');
	
			$admin->show();
		
		break;
		
		/*case 1:
		
			PhangoVar::$model['shopindex_content']->create_form();
			
			PhangoVar::$model['shopindex_content']->forms['description']->form='TextAreaBBForm';
		
			$admin=new GenerateAdminClass('shopindex_content');
	
			$admin->url_options=set_admin_link('content', array('op' => 1));
			$admin->url_back=$admin->url_options;
	
			$admin->arr_fields=array('title');
	
			$admin->show();
		
		break;*/
	
	}

}

?>