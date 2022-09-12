<?php if( !empty( $filtro->brand ) ){ ?>
<h4 class="marca" data-id="<?= $brandId ?>" data-slug="<?= $brandSlug ?>" >
	<?= $filtro->brand ?>
	<span onclick="removeFilter(this)" ></span>
</h4>
<?php } ?>

<?php if( !empty( $filtro->model ) ){ ?>
<h4 class="modelo" data-id="<?= $modelId ?>" data-slug="<?= $modelSlug ?>" >
	<?= $filtro->model ?>
	<span onclick="removeFilter(this)" ></span>
</h4>	
<?php } ?>

<?php if( $versionGet != "" ){ ?>
<h4 class="version" data-slug="<?= $versionGet ?>" >
	<?= get_the_title( $versionGet ); ?>
	<span onclick="removeFilter(this)" ></span>
</h4>	
<?php } ?>	

<?php if( $transmisionGet != "" ){ ?>
<h4 class="transmision" data-slug="<?= $transmisionGet ?>" >
	<?= ucwords( mb_convert_case( $transmisionGet, MB_CASE_LOWER, "UTF-8" ) ); ?>
	<span onclick="removeFilter(this)" ></span>
</h4>	
<?php } ?>

<?php if( $combuGet != "" ){ ?>
<h4 class="combustible" data-slug="<?= $combuGet ?>" >
	<?= ucwords( mb_convert_case( $combuGet, MB_CASE_LOWER, "UTF-8" ) ); ?>
	<span onclick="removeFilter(this)" ></span>
</h4>	
<?php } ?>		

<?php if( $segmentosGet != "" ){ ?>
<h4 class="segmentos" data-slug="<?= $segmentosGet ?>" >
	<?= ucwords( mb_convert_case( $segmentosGet, MB_CASE_LOWER, "UTF-8" ) ); ?>
	<span onclick="removeFilter(this)" ></span>
</h4>	
<?php } ?>

<?php if( $kmsGet != "" ){ ?>
<h4 class="kilometraje" data-slug="<?= $kmsGet ?>" >
	<?php
		$kms = formatingValues($kmsGet,"kms");
		echo $kms;
	?>
	<span onclick="removeFilter(this)" ></span>
</h4>	
<?php } ?>

<?php if( $precioGet != "" ){ ?>
<h4 class="precio" data-slug="<?= $precioGet ?>" >
	<?php
		$precio = formatingValues($precioGet,"precio");
		echo $precio;
	?>
	<span onclick="removeFilter(this)" ></span>
</h4>	
<?php } ?>	

<?php if( $anoGet != "" ){ ?>
<h4 class="ano" data-slug="<?= $anoGet ?>" >
	<?php
		$ano = formatingValues($anoGet,"a");
		echo $ano;
	?>
	<span onclick="removeFilter(this)" ></span>
</h4>	
<?php } ?>	