<?php 

// namespace EinaDev\Module\Schema;

class Schema_Item{

	protected $schema_object;
	protected $item_type;
	protected $item_content;


	public function __construct( array $config ) {

		// foreach( $config as $property => $value ) {
		// 	$this->{$property} = $value;
		// }

		// ddd ($config);

		$this->create_item( $config );

	}

	protected function create_item( $config ) {

		$this->initialize_item( $config );	
		$this->add_content();
		$this->convert_to_json_and_render();

	}

	protected function initialize_item( $config ) {

		$this->item_type = (string) $config['type'];
		$this->item_content = (array) $config['content'];
		$this->schema_object['@context'] = "http://schema.org";
		$this->schema_object['@type'] = $this->item_type;
		// ddd($this->item);


	}

	protected function add_content(){

		switch ($this->item_type) {
		 	case 'FAQPage':
		 		$this->add_faq_content();
		 		break;

		 	default:
		 		$this->add_default_content();
		 		break;
		 }

	}

	protected function add_default_content(){



		$this->schema_object = array_merge ($this->schema_object, $this->item_content);

		// ddd ($this->schema_object);
	}

	protected function add_faq_content(){

		$faqs = array();

		foreach ( $this->item_content as $key => $value ) {
			$faq = array();
			$faq['@type'] = 'Question';
			$faq['name'] = $value['question'];
			$faq['acceptedAnswer'] = array();
			$faq['acceptedAnswer']['@type'] = 'Answer';
			$faq['acceptedAnswer']['text'] = $value['answer'];
			array_push($faqs, $faq);
		}

		$this->schema_object['mainEntity'] = $faqs;

	}


	protected function convert_to_json_and_render(){?>

            <script type="application/ld+json">
                    <?php echo wp_json_encode( $this->schema_object, JSON_UNESCAPED_UNICODE ); ?>
            </script>


<?php	}

}



// 	 {
//       "@context": "https://schema.org",
//       "@type": "FAQPage",
//       "mainEntity": [{
//         "@type": "Question",
//         "name": "What is the return policy?",
//         "acceptedAnswer": {
//           "@type": "Answer",
//           "text": "Most unopened items in new condition and returned within <strong>90 days</strong> will receive a refund or exchange. Some items have a modified return policy noted on the receipt or packing slip. Items that are opened or damaged or do not have a receipt may be denied a refund or exchange. Items purchased online or in-store may be returned to any store.<br /><p>Online purchases may be returned via a major parcel carrier. <a href=http://example.com/returns> Click here </a> to initiate a return.</p>"
//         }
//       }, {
//         "@type": "Question",
//         "name": "How long does it take to process a refund?",
//         "acceptedAnswer": {
//           "@type": "Answer",
//           "text": "We will reimburse you for returned items in the same way you paid for them. For example, any amounts deducted from a gift card will be credited back to a gift card. For returns by mail, once we receive your return, we will process it within 4–5 business days. It may take up to 7 days after we process the return to reflect in your account, depending on your financial institution's processing time."
//         }
//       }, {
//         "@type": "Question",
//         "name": "What is the policy for late/non-delivery of items ordered online?",
//         "acceptedAnswer": {
//           "@type": "Answer",
//           "text": "Our local teams work diligently to make sure that your order arrives on time, within our normaldelivery hours of 9AM to 8PM in the recipient's time zone. During  busy holiday periods like Christmas, Valentine's and Mother's Day, we may extend our delivery hours before 9AM and after 8PM to ensure that all gifts are delivered on time. If for any reason your gift does not arrive on time, our dedicated Customer Service agents will do everything they can to help successfully resolve your issue. <br/> <p><a href=https://example.com/orders/>Click here</a> to complete the form with your order-related question(s).</p>"
//         }
//       }, {
//         "@type": "Question",
//         "name": "When will my credit card be charged?",
//         "acceptedAnswer": {
//           "@type": "Answer",
//           "text": "We'll attempt to securely charge your credit card at the point of purchase online. If there's a problem, you'll be notified on the spot and prompted to use another card. Once we receive verification of sufficient funds, your payment will be completed and transferred securely to us. Your account will be charged in 24 to 48 hours."
//         }
//       }, {
//         "@type": "Question",
//         "name": "Will I be charged sales tax for online orders?",
//         "acceptedAnswer": {
//           "@type": "Answer",
//           "text":"Local and State sales tax will be collected if your recipient's mailing address is in: <ul><li>Arizona</li><li>California</li><li>Colorado</li></ul>"}
//         }]
//     }


// 	$schema['@context'] = "http://schema.org";
// 	$schema['@type'] = $type;
	
// 	$schema["mainEntityOfPage"] = array(
// 		"@type" => "WebPage",
// 		"@id" => $json['permalink']
// 		);
	
// 	$schema["url"] = $json['permalink'];
	
// 	/*
// 	$schema["author"] = array(
// 		"@type"	=> "Person",
// 		"name"	=> $json['author']['author_name'],
// 		"url"	=> $json['author']['author_posts_link'],
// 		);
// 	*/
	
// 	$schema["headline"] = $json["headline"];
	
// 	//$schema["datePublished"]	= $json["datePublished"];
// 	//$schema["dateModified"]	= $json["dateModified"];
	
// 	if ( ! empty( $json["media"] ) ) {
// 		$schema["image"] = array(
//     		"@type"		=> "ImageObject",
//     		"url"		=> isset($json["media"]["url"]) ? $json["media"]["url"] : '',
//     		"width"		=> isset($json["media"]["width"]) ? $json["media"]["width"] : '',
// 			"height"	=> isset($json["media"]["height"]) ? $json["media"]["height"] : ''
// 		);
// 	}
	
// 	if ( ! empty( $json["publisher"] ) ) {
// 		$schema["publisher"] = $json["publisher"];
// 	}
	
	
// 	if ( $json["description"] != '' )  {
// 		$schema["description"] = $json["description"];
// 	}

// }
