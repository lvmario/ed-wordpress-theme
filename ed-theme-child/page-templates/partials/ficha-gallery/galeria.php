<?php if( $imagenes != NULL ){ ?>
<style>#elementor-lightbox-slideshow-all-1739eff1{ display:none }</style>

<div class="dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox elementor-lightbox" id="elementor-lightbox-slideshow-all-1739eff1" >
    <div class="dialog-widget-content dialog-lightbox-widget-content elementor-aspect-ratio-169" >
	
        <div tabindex="0" role="button" aria-label="Close (Esc)" class="dialog-close-button dialog-lightbox-close-button">
			<i class="eicon-close"></i>
		</div>
		
        <div class="dialog-header dialog-lightbox-header"></div>
		
        <div class="dialog-message dialog-lightbox-message animated zoomIn">
		
            <div class="swiper-container swiper-container-initialized swiper-container-horizontal elementor-slideshow--ui-hidden" style="cursor: grab;">
			
                <div class="swiper-wrapper" >
				
					<?php foreach( $imagenes as $key => $imagen ): ?>
                    <div class="swiper-slide elementor-lightbox-item swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="<?= $key ?>" >
                        <div class="swiper-zoom-container">
							<img 	class="elementor-lightbox-image elementor-lightbox-prevent-close swiper-lazy swiper-lazy-loaded" 
									src="<?= $imagen["base"].$imagen["thumbnail_url"]; ?>" 
							/>
						</div>
                    </div>
					<?php endforeach; ?>
					
                </div>
				
                <div class="elementor-swiper-button elementor-swiper-button-next elementor-lightbox-prevent-close" aria-label="Next slide" tabindex="0" role="button">
					<i class="eicon-chevron-right"></i>
				</div>
				
                <div class="elementor-swiper-button elementor-swiper-button-prev elementor-lightbox-prevent-close" aria-label="Previous slide" tabindex="0" role="button">
					<i class="eicon-chevron-left"></i>
				</div>
				
            </div>
        </div>
		
    </div>
</div>
<?php } ?>