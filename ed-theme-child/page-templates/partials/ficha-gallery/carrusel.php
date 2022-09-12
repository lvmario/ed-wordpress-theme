<?php if( $imagenes != NULL ){ ?>
<section id="ac-product-gallery-wrapper" class="ac-product-gallery-wrapper" >

    <div data-elementor-type="section" data-elementor-id="1014" class="elementor elementor-1014" data-elementor-settings="[]">
        <div class="elementor-section-wrap">
            <section class="elementor-section elementor-top-section elementor-element elementor-element-5dd8c215 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="5dd8c215" data-element_type="section">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-617cfd0c" data-id="617cfd0c" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-1739eff1 ac-single-product-gallery elementor-widget elementor-widget-gallery" data-id="1739eff1" data-element_type="widget" data-settings="{&quot;columns&quot;:1,&quot;gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:0,&quot;sizes&quot;:[]},&quot;gallery_layout&quot;:&quot;grid&quot;,&quot;columns_tablet&quot;:2,&quot;columns_mobile&quot;:1,&quot;gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;link_to&quot;:&quot;file&quot;,&quot;aspect_ratio&quot;:&quot;3:2&quot;,&quot;content_hover_animation&quot;:&quot;fade-in&quot;}" data-widget_type="gallery.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-gallery__container e-gallery-container e-gallery-grid e-gallery--ltr" style="--hgap:0px; --vgap:0px; --animation-duration:350ms; --columns:1; --rows:3; --aspect-ratio:66.6667%; --container-aspect-ratio:200%;">
									
										<?php foreach( $imagenes as $key => $imagen ): ?>
                                        <a 
											class="e-gallery-item elementor-gallery-item elementor-animated-content" 
											href="<?= $imagen["base"].$imagen["thumbnail_url"]; ?>" 
											data-elementor-open-lightbox="yes" 
											data-elementor-lightbox-slideshow="all-1739eff1"
											>
                                            <div 
												class="e-gallery-image elementor-gallery-item__image" 
												data-thumbnail="<?= $imagen["base"].$imagen["thumbnail_url"]; ?>" 
												style="background-image: url('<?= $imagen["base"].$imagen["thumbnail_url"]; ?>');"
											></div>
                                        </a>
										<?php endforeach; ?>
										
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="autocity-gallery-nav-wrapper">

        <div class="autocity-gallery-buttons-arrows" >
            <button class="autocity-gallery-button-prev-arrow">
                <img src="<?= ASSETS_URL ?>images/layouts/icons/chevronLeft.svg" alt="Retroceder">
            </button>
            <button class="autocity-gallery-button-next-arrow">
                <img src="<?= ASSETS_URL ?>images/layouts/icons/chevronRight.svg" alt="Avanzar">
            </button>
        </div>

    </div>

</section>
<?php } ?>