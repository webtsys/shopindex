<?php 

function ShopIndexView($arr_image, $arr_product, $arr_photo)
{

	PhangoVar::$arr_cache_jscript[]='jquery.min.js';
	PhangoVar::$arr_cache_jscript[]='owl-carousel/owl.carousel.min.js';
	PhangoVar::$arr_cache_jscript[]='show_big_image2.js';
	PhangoVar::$arr_cache_jscript['shopindex'][]='nivoslider/jquery.nivo.slider.pack.js';
	
	//PhangoVar::$arr_cache_css['shopindex'][]='style.css';
	
	PhangoVar::$arr_cache_css[]='owl.carousel.css';
	PhangoVar::$arr_cache_css[]='owl.theme.css';
	
	PhangoVar::$arr_cache_css['shopindex'][]='everindex.css';
	PhangoVar::$arr_cache_css['shopindex'][]='nivo-slider.css';
	PhangoVar::$arr_cache_css['shopindex'][]='default.css';

	$c_product=count($arr_product);
	
	ob_start();
	
	?>
	<script language="javascript">
		$(document).ready(function(){
		
			$('#slider').nivoSlider({
				pauseTime: 6000,
				
				afterChange: function() {
				
					$('#slider .nivo-caption').children('.title_slide').animate({ top: '+=300px'}, 'slow');
					$('#slider .nivo-caption').children('.cont_slide').fadeIn('slow');
					//alert($('#slider .nivo-caption').attr('class'));
				}, 
				
				beforeChange: function () {
					
					//$('.title_slide').css( 'top', '-300px');
					$('#slider .nivo-caption').children('.title_slide').animate({ top: '-=300px'}, 'slow');
					$('#slider .nivo-caption').children('.cont_slide').fadeOut('slow');
					
				},
				
				afterLoad: function() {
				
					//alert($('#slide_0').children('.title_slide').attr('class'));
					$('#slider .nivo-caption').children('.title_slide').animate({ top: '+=300px'}, 'slow');
					$('#slider .nivo-caption').children('.cont_slide').fadeIn('slow');
					//alert($('#slider .nivo-caption').attr('class'));
				}, 
			
			});
			
			//Now the image carousel...
			
			$("#owl-demo").owlCarousel({
 
				autoPlay: 3000, //Set AutoPlay to 3 seconds
				
				items : 4,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [979,3],
				scrollPerPage : true,
				paginationNumbers: true,
			
			});
			
			//$('.image_product').ShowBigImage();
		
		});
	</script>
	<?php
	
	PhangoVar::$arr_cache_header[]=ob_get_contents();
	
	ob_end_clean();
	
	ob_start();

	?>
	<div id="container_slider">
		<div id="slider" class="nivoSlider theme-default">
		<?php
		
		$x=0;
		
		foreach($arr_image as $image)
		{
		
		?>
			<img src="<?php echo get_url_image('carousel/'.$image['image'], 'shopindex'); ?>" title="#slide_<?php echo $x; ?>" />
		<?php
		
			$x++;
		
		}
		
		?>
		</div>
		<?php
		
		$x=0;
		
		foreach($arr_image as $image)
		{
		
		?>
		<div id="slide_<?php echo $x; ?>" class="nivo-html-caption">
			<div class="title_slide">
				<?php echo $image['title']; ?>
			</div>
			<div class="cont_slide">
				<?php echo $image['description']; ?>
			</div>
		</div>
		<?php
		
		$x++;
		
		}
		
		?>
	</div>
	<div class="title_line"><div class="title">Últimas novedades</div></div>
	<!--<div id="carousel_images_container">-->
		<div id="owl-demo">	
			<?php
			foreach($arr_product as $idproduct => $product)
			{
			//PhangoVar::$model['image_product']->components['photo']->show_image_url($arr_photo[$idproduct]); 
			
			$title_formatted=I18nField::show_formatted($product['title']);
			
			$offer_div='';
					
			$price_final=MoneyField::currency_format($product['price']);
			
			if($product['special_offer']>0)
			{
			
				$offer_div='<span class="offer">¡¡¡Oferta!!!</span>';
			
				$price_final='<span style="text-decoration:line-through;">'.$price_final.'</span> '.MoneyField::currency_format($product['special_offer']);
			
			}
			
			?>
			<div class="item">
				<a class="image_product" href="<?php echo make_fancy_url(PhangoVar::$base_url, 'shop', 'viewproduct', array($idproduct, slugify($title_formatted))); ?>" >
					<?php echo $offer_div; ?>
					<div class="show_item">Ver</div>
					<img src="<?php echo PhangoVar::$model['image_product']->components['photo']->show_image_url('medium_'.$arr_photo[$idproduct]); ?>" alt="<?php $arr_photo[$idproduct]; ?>" border="0" style="height:225px;" />
				</a>
				<div class="product_item">
					<h3><?php echo $title_formatted; ?></h3>
				
					<span class="price"><?php echo $price_final; ?></span>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	<!--</div>-->
	
	<?php
	
}

?>