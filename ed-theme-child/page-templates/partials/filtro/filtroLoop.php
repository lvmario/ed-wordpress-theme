<?php

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
//echo $paged;
$orderby = ( get_query_var('orderby') ) ? get_query_var('orderby') : "_regular_price";

//echo $orderby;

//echo $orderby; echo "meta_value_num";

$order = ( get_query_var('order') ) ? get_query_var('order') : "_regular_price";


$orderDefaultM = orderDefaultMeta();
$meta_key = ( get_query_var('meta_key') ) ? get_query_var('meta_key') : $orderDefaultM;

//echo $order;
//echo $meta_key;

if( $filtro->taxonomyName == "product" ){
	
	$argumentos = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'paged' => $paged,
		'orderby'   => "meta_value_num",
		'meta_key'  => $meta_key, 
		'order'     => $order	   
	);	
	
}else{
	
	$argumentos = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'paged' => $paged,
		'orderby'   => "meta_value_num",
		'meta_key'  => $meta_key, 
		'order'     => $order,
		'tax_query' => [
			[
				'taxonomy' => $filtro->taxonomy,
				'field'    => 'term_id',
				'terms'    => $filtro->term_id,
				'operator' => 'IN'
			],
		]	   
	);	

}

if( $searchGet != "" ){
		
	$idsFinalesT = $attrFiltro->getIdsSearch;
	$argsinal = $attrFiltro->arguFilSearch;
	
	
	//var_dump($argsinal);
	//var_dump($idsFinalesT);
	//echo "asdasdas asdas";
	
	if( empty( $idsFinalesT ) ){
		$productos = array();
	}else{
		$productosIds = new WP_Query( $argsinal );		
		
		$prodsIds = array();
		
		if ( $productosIds->have_posts() ){	
			while ( $productosIds->have_posts() ):
				$productosIds->the_post();
				
				$id = get_the_ID();
				
				$prodsIds[] = $id;
			
			endwhile;
		}
		
		wp_reset_postdata();	

		$argumentos = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'paged' => $paged,
			'orderby'   => "meta_value_num",
			'meta_key'  => $meta_key, 
			'order'     => $order,
			'post__in' => $prodsIds 			
		);	

		$productos = new WP_Query( $argumentos );		
		
	}	

	//var_dump($productos);
		
}


if( $searchGet == "" ){
	
	$argumentos += $attrFiltro->finalRet;
	
	//var_dump($argumentos);

	$productos = new WP_Query( $argumentos );	
}	


