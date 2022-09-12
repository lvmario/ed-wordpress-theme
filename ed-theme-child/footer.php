</div> <!-- #page -->

<footer id="footer">
	<div class="dynamic-footer">
		<?php dynamic_sidebar( 'footer' );  ?>
	</div>
	<div class="copyright-footer">
		<p>
			<span>©2021 autocity.com.ar</span>
			<span>Todos los derechos reservados</span>
			<a href="<?php echo esc_url( site_url(). "/terminos-y-condiciones/" ); ?>">Términos y Condiciones  |</a>
			<a href="<?php echo esc_url( site_url(). "/politicas-de-privacidad/" ); ?>/#politicas">Políticas de Privacidad  |</a>
			<a href="<?php echo esc_url( site_url(). "/legales/" ); ?>"> Legales</a>
		</p> 
		<a class="logo-grupo-table" href="https://www.grupotagle.com.ar/">
			<img class="img-fluid" src="<?php echo esc_url ( get_stylesheet_directory_uri() . "/assets/images/logo/grupo-tagle.svg" ); ?>" alt="Logo Grupo Tagle">
		</a>		
	</div>

	<?php wp_footer(); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141784381-1"></script>
	<script>  window.dataLayer = window.dataLayer || [];  function gtag(){dataLayer.push(arguments);}  gtag('js', new Date());  gtag('config', 'UA-141784381-1');</script>

</footer>

</body>
</html>
