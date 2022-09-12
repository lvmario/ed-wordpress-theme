<div class="overlay"></div>
<section id="sidesheet" class="wrapperSidesheet sidesheetmodelos">
	
	<div class="conteSidesheet">
	
		<div class="fcontent">
		
			<div class="preloadSide">
				<div class="loaderWrapper">
					<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
				</div>					
			</div>			
			
			<div class="conteClose">
				<a href="javascript:void(0)" class="close sidesheetmodelos" onclick="closeSideSheet(this)" ></a>
			</div>			
			
			<h2>Modelos</h2>	
			
			<form class="buscador-autocity-form">
			
			  <div class="buscador-autocity-input-wrapper">
				<input class="buscador-autocity-input" id="searchModelos" autocomplete="off" type="text" placeholder="Escribí el modelo del auto">
			  </div>

			</form>			
			
		</div>	
		
		<div class="tableWrapper">
		
			<?php
				
				ksort( $modelos,SORT_STRING );
								
				$listF = orderItems2( $modelos, false, true );
				
				//var_dump($listF);
				$returnHtml = htmlRender2( $listF, true, "modelos" );				
				
				echo $returnHtml;
				
			?>
		</div>
		
	</div>	
	
</section>