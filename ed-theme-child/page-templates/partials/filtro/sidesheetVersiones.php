<div class="overlay"></div>
<section id="sidesheet" class="wrapperSidesheet sidesheetversiones">
	
	<div class="conteSidesheet">
	
		<div class="fcontent">
		
			<div class="preloadSide">
				<div class="loaderWrapper">
					<img src="/wp-content/themes/ed-theme-child/assets/images/layouts/icons/loader.gif" />
				</div>					
			</div>			
			
			<div class="conteClose">
				<a href="javascript:void(0)" class="close sidesheetversiones" onclick="closeSideSheet(this)" ></a>
			</div>			
			
			<h2>Versiones</h2>	
			
			<form class="buscador-autocity-form">
			
			  <div class="buscador-autocity-input-wrapper">
				<input class="buscador-autocity-input" type="text" autocomplete="off" id="searchVersions" placeholder="Escribí la versión del auto">
			  </div>

			</form>			
			
		</div>	
		
		<div class="tableWrapper">
		
			<?php
				
				$versionFinal = $attrFiltro->versionFinal;
				ksort( $versionFinal );
				
				$listF = orderItems2( $versionFinal, true );
				
				//var_dump($listF);
				$returnHtml = htmlRender2( $listF, true, "versiones" );
				
				echo $returnHtml;
				
			?>
		</div>
		
	</div>	
	
</section>