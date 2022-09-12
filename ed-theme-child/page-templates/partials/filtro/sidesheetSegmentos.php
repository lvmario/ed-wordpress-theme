<div class="overlay"></div>
<section id="sidesheet" class="wrapperSidesheet sidesheetsegmentos">
	
	<div class="conteSidesheet">
	
		<div class="fcontent">
		
			<div class="preloadSide">
				<div class="loaderWrapper">
					<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
				</div>					
			</div>			
			
			<div class="conteClose">
				<a href="javascript:void(0)" class="close sidesheetsegmentos" onclick="closeSideSheet(this)" ></a>
			</div>			
			
			<h2>Segmentos</h2>	
			
			<form class="buscador-autocity-form">
			
			  <div class="buscador-autocity-input-wrapper">
				<input class="buscador-autocity-input" type="text" autocomplete="off" id="searchSegs" placeholder="Escribí el segmento del auto">
			  </div>

			</form>			
			
		</div>	
		
		<div class="tableWrapper">
		
			<?php
				
				//var_dump($segmentosFinal);
				
				ksort( $segmentosFinal,SORT_STRING );
								
				$listF = orderItems2( $segmentosFinal, false );
				
				//var_dump($listF);
				$returnHtml = htmlRender2( $listF, true, "segmentos" );				
				
				echo $returnHtml;
				
			?>
		</div>
		
	</div>	
	
</section>