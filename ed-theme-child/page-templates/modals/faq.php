<!-- Modal -->
<div class="modal" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="close-btn"></i></button>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-5">
							<div class="container_categories tabs row">
								<?php
								// FAQs Categories List
								$faq_cats = clk_tv_get_faq_categories();
								$i = 0;
								foreach ($faq_cats as $faq_cat) {

									//Escaping content
									$faq_cat_name = esc_html ( $faq_cat->name );
									$faq_cat_icon = esc_url ( $faq_cat->icon );
									$faq_cat_slug = esc_attr ( $faq_cat->slug );
									$faq_cat_term_id = esc_attr ( $faq_cat->term_id );

									echo 	'<button aria-label="'. $faq_cat_name . ' categoria" class="category_box tab-link col-6 col-sm-12" data-tab="tab-' . $faq_cat_slug . '">
												<img class="cat-icon" src="' . $faq_cat_icon . '" />' . $faq_cat_name . '</button>';

									$i++;

								}
								?>
							</div>
						</div>
						<div class="container_content_tabs col-12 col-sm-7">
							<div class="welcome_text offset-1">
								<h4 class="title">Como podemos<br> te ajudar?</h4>
								<div class="social-media">
									<h3 class="subtitle">Converse conosco</h3>
									<div class="icons">
										<a href="https://www.facebook.com/vale.garrafa" aria-label="facebook" target="_blank" rel="noopener"><i class="fb"></i></a>
										<a href="https://www.instagram.com/valegarrafa/" aria-label="instagram" target="_blank" rel="noopener"><i class="ig"></i></a>
										<a href="https://wa.me/+5581982500101" aria-label="whatsapp" target="_blank" rel="noopener"><i class="whatsapp"></i></a>
									</div>
								</div>
							</div>
							<?php
							// FAQs Questions List
							foreach ($faq_cats as $faq_cat) {
								$faqs = clk_tv_get_faqs($faq_cat->term_id);
								
	
								echo '<div id="tab-' . $faq_cat->slug . '" class="tab-content">
								<div id="accordion-' . $faq_cat->term_id . '">';


								$first = true;
								$schema_faq_content = array();
								foreach ($faqs as $faq) {
									//Escaping content

									$faq_ID = esc_attr ( $faq->ID );
									$faq_post_title = esc_html ( $faq->post_title );
									$faq_post_content =  wp_kses_post ( $faq->post_content );
									$faq_cat_term_id = esc_attr ( $faq_cat->term_id );

									if ($first) {
										$visible_class = 'show';
										$btn_class = '';
										$aria_expanded = 'true';
										$first = false;
									} else {
										$visible_class = '';
										$btn_class = 'collapsed';
										$aria_expanded = 'false';
									}
									echo '
										<div class="card">
											<div class="card-header" id="header_card_' . $faq_ID . '">

													<button class="title-button btn btn-link ' . $btn_class . '" data-toggle="collapse" data-target="#TarjetaTab' . $faq_ID . '" aria-label="Expanda a resposta para pergunta: ' . $faq_post_title . '" aria-expanded="' . $aria_expanded . '" aria-controls="TarjetaTab' . $faq_ID . '">
														' . $faq_post_title . '
													</button>
										

												<button class="btn btn-link arrow ' . $btn_class . '" data-toggle="collapse" data-target="#TarjetaTab' . $faq_ID . '" aria-label="Expanda a resposta para pergunta: ' . $faq_post_title . '" aria-expanded="' . $aria_expanded . '" aria-controls="TarjetaTab' . $faq_ID . '">
												<img src="' . esc_url(  get_stylesheet_directory_uri() . "/assets/images/layouts/icons/arrow-upward.svg" ).'"  alt="">
												</button>
											</div>

											<div id="TarjetaTab' . $faq_ID . '" class="collapse ' . $visible_class . '" aria-labelledby="header_card_' . $faq_ID . '" data-parent="#accordion-' . $faq_cat_term_id . '">
												<div class="card-body">
													<p class="faq-content">' . $faq_post_content . '</p>
													<div class="question-box" aria-labelledby="question-box-title_' . $faq_ID . '" >
														<p class="question" id="question-box-title_' . $faq_ID . '" >Esta informação foi útil?</p>
														<div class="questions_buttons">
															<button type="button" class="btn btn_yes_no btn-faq-' . $faq_ID . ' btn-faq-' . $faq_ID . '-yes" onClick="ajaxFAQvote(\'' . $faq_ID . '\', 1)"><span>Sim</span></button>
															<button type="button" class="btn btn_yes_no btn-faq-' . $faq_ID . ' btn-faq-' . $faq_ID . '-no" onClick="ajaxFAQvote(\'' . $faq_ID . '\', -1)"><span>Não</span></button>
														</div>
													</div>
												</div>
											</div>
										</div>';
										//Save content for Schema Items
										array_push ( $schema_faq_content, array ('question' => $faq_post_title, 'answer' => strip_tags ($faq_post_content) ) ); //18C

								} //foreach $faqs

								echo '</div>
								<div class="footer_card">
									<p class="question">Você tem alguma pergunta?</p>
									<button type="button" class="voltar-ao-inicio" data-dismiss="modal" aria-label="Close">Voltar ao início</button>
								</div>					
							</div>';
							} //foreach $faq_cats
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		//Tabs behavior
		document.addEventListener("DOMContentLoaded", function() {
			jQuery(".tabs .tab-link").click(function () {
			      const tab_id = jQuery(this).attr("data-tab");

			      jQuery(".welcome_text").addClass("d-none");
			      jQuery(".tabs .tab-link").removeClass("current");
			      jQuery(".tab-content").removeClass("current");

			      jQuery(this).addClass("current");
			      jQuery("#" + tab_id).addClass("current");

			      //Add focus for first card into the selected accordion 
			      var firstCard =  jQuery("#" + tab_id + " .card").first();
			      firstCard.find( '.title-button').focus();
			});	      
		});	

		function ajaxFAQvote(faq_id, vote) {

			jQuery('.btn-faq-' + faq_id).prop('disabled', true);

			if (vote == 1) {
				jQuery('.btn-faq-' + faq_id + '-yes').addClass('selected');
			} else {
				jQuery('.btn-faq-' + faq_id + '-no').addClass('selected');
			}


			var data = {
				'action': 'clk_tv_faq_vote',
				'faq_id': faq_id,
				'vote': vote
			};

			jQuery.post("<?= site_url('/wp-admin/admin-ajax.php'); ?>", data, function(response) {

				//jQuery('.login-button').prop('disabled', false);
				//jQuery('.login-classic').removeClass('login-button-loading');

			});
		}
	</script>
	<?php

		$config_faq_schema_object =  array ( 'type' => 'FAQPage',
						  					 'content' => $schema_faq_content 
											);

		do_action ( 'vg_faq_modal_rendered',  $config_faq_schema_object );

	?>

</div>	