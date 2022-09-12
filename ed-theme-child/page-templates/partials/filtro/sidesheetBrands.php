<div class="overlay"></div>
<section id="sidesheet" class="wrapperSidesheet sidesheetmarcas">
	
	<div class="conteSidesheet">
	
		<div class="fcontent">
		
			<div class="preloadSide">
				<div class="loaderWrapper">
					<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
				</div>					
			</div>			
			
			<div class="conteClose">
				<a href="javascript:void(0)" class="close sidesheetmarcas" onclick="closeSideSheet(this)" ></a>
			</div>			
			
			<h2>Marcas</h2>	
			
			<form class="buscador-autocity-form">
			
			  <div class="buscador-autocity-input-wrapper">
				<input class="buscador-autocity-input" id="searchMarcas" autocomplete="off" type="text" placeholder="Escribí la marca del auto" >
			  </div>

			</form>			
			
		</div>	
		
		<div class="tableWrapper">
		
			<?php
				//var_dump($marcas);
				ksort( $marcas, SORT_STRING );				
				$listF = orderItems2( $marcas, false, true );
				
				$returnHtml = htmlRender2( $listF, true, "marcas" );				
				
				echo $returnHtml;
	
				
			?>
		</div>
		
	</div>	
	
</section>