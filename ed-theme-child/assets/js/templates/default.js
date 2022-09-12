/*

Si impreme este codigo trae error en el hero

//VG default template functions

// Fix for vh units on mobile devices, inspired by https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
let vh = window.innerHeight * 0.01;
let vw = window.innerWidth * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);

// We listen to the resize event
window.addEventListener('resize', () => {
  // We execute the same script as before
  let vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
});
*/


jQuery(document).ready(function() {
	
	
	//Handle active class on nav links
	// jQuery('li.active').removeClass('active');
	jQuery('a[href="' + location.href + '"]').closest('li').addClass('active'); 
  
  
	//Go to top functionality
	jQuery("#go-to-top").click(function () {
		window.scrollTo(0, 0);
	});  
  
	//submenu effects
	if( jQuery( "#masthead" ).length ){
		jQuery ('li.menu-item:has(ul) > a').click(event, function(e){
			
			e.preventDefault();

			if( jQuery("#masthead").hasClass( "submenu-open" ) ){
				jQuery(this).parent().removeClass("open");
				jQuery("#masthead").removeClass("submenu-open");	
			}else{
				jQuery(this).parent().addClass("open");
				jQuery("#masthead").addClass("submenu-open");
			}
			
		});
		
		// class on scroll event to change menu behaviour
		toggleHeaderClassOnScroll();
		
		jQuery ('.navbar-toggler').click(event, function(){
			jQuery("#masthead").toggleClass("mobile-menu-open");
		});		
		
	}
	
		
	
	
	//got to map
	if( jQuery( "#mapa" ).length ){

		jQuery(".scrollToMap a").on('click', function(event) {
		  
			if (this.hash !== "") {
			  event.preventDefault();
			  
			  var hash = this.hash;
			  
			  //console.log( hash );
			  
			  jQuery('html, body').animate({
				scrollTop: jQuery(hash).offset().top
			  }, 800, function(){
				//window.location.hash = hash;
			  });
			}
		});	
		
	}	
	
	if( jQuery( ".sent-another-message" ).length ){

		jQuery(".sent-another-message").on('click', function(event) {
			event.preventDefault();
				
			if( jQuery( this ).hasClass("sucModalsSucces") ){

				jQuery(".sucModals .modal-content.form").show();
				jQuery(".sucModals .modal-content.form-success").hide();			
				
			}else if( jQuery( this ).hasClass("cerrarModal") ){
				jQuery("#contacto").modal('hide');
				
				jQuery("#contacto .modal-content.form").show();
				jQuery("#contacto .modal-content.form-success").hide();					
			}else{
				jQuery("#contacto .modal-content.form").show();
				jQuery("#contacto .modal-content.form-success").hide();			
			}	
		});		
		
	}
	
	if( jQuery( "body.home" ).length ){
		
		jQuery( "#footer .footer-social-media a.logo").click( function( event ){
			
			event.preventDefault();

			  jQuery('html, body').animate({
				scrollTop: jQuery("body").offset().top
			  }, 800, function(){
				//window.location.hash = hash;
			  });			
			
		})
		
		jQuery( "a.navbar-brand" ).click( function( event ){
			
			event.preventDefault();

			  jQuery('html, body').animate({
				scrollTop: jQuery("body").offset().top
			  }, 800, function(){
				//window.location.hash = hash;
			  });			
			
		})		
	}
	
	if( jQuery( "#descargarPdf" ).length ){
		
		jQuery( "#descargarPdf .elementor-button-link" ).attr( "href", '/wp-content/uploads/2021/09/brochure_corporate.pdf');
		jQuery( "#descargarPdf .elementor-button-link" ).attr( "download","brochure_corporate");
		
	}
  
});  



function toggleHeaderClassOnScroll (){
		
    var header = document.getElementById('masthead');
    var headerHeight = header.offsetHeight;
	
	
    window.onscroll = function () { 

        if (document.body.scrollTop >= headerHeight || document.documentElement.scrollTop >= headerHeight ) {
            header.classList.add("scrolled");
        } 
        else {
            header.classList.remove("scrolled");
        }

    };
	
}
