<div class="overlay"></div>
<section id="sidesheet" class="wrapperSidesheet sidesheetcombustible">
	
	<div class="conteSidesheet">
	
		<div class="fcontent">
		
			<div class="preloadSide">
				<div class="loaderWrapper">
					<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
				</div>					
			</div>			
			
			<div class="conteClose">
				<a href="javascript:void(0)" class="close sidesheetcombustible" onclick="closeSideSheet(this)" ></a>
			</div>			
			
			<h2>Combustible</h2>	
			
			<form class="buscador-autocity-form">
			
			  <div class="buscador-autocity-input-wrapper">
				<input class="buscador-autocity-input" type="text" autocomplete="off" id="searchCombus" placeholder="Escribí el combustible del auto">
			  </div>

			</form>			
			
		</div>	
		
		<div class="tableWrapper">
		
			<?php
				
				//var_dump($combustibleFinal);
				
				ksort( $combustibleFinal,SORT_STRING );
								
				$listF = orderItems2( $combustibleFinal, false );
				
				//var_dump($listF);
				$returnHtml = htmlRender2( $listF, true, "combu" );				
				
				echo $returnHtml;
				
			?>
		</div>
		
	</div>	
	
</section>