<?php

function getEmail($urlFinal,$url){


ob_start(); 
?>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <!--[if mso]><noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript><![endif]-->
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tbody>
            <tr>
                <td align="center" style="padding:0;">
                    <table role="presentation" style="width: 482px;border-collapse:collapse;border-spacing:0;text-align:left;">
                        <tbody>
                            <tr>
                                <td align="left" style="padding: 25px 0 25px 25px;background: #000000;"><img src="<?= $url ?>/wp-content/themes/ed-theme-child/assets/images/email/logo.png" alt="" width="142" style="height:auto;display:block;"></td>
                            </tr>
                            <tr>
                                <td style="padding: 36px 30px 0 30px;">
                                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 0 0 26px 0;color:#153643;">
                                                    <h1 style="font-size: 24px;margin: 0 0 0px 0;font-family:Arial,sans-serif; text-align:center">Tu presupuesto fue enviado con &eacute;xito.</h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0 0 0px 0;color:#153643;">
                                                    <p style="margin: 0;font-size: 15px;line-height:24px;font-family:Arial,sans-serif;font-weight: 600;">Un asesor comercial se contactar&aacute; en el transcurso de las 24 hs. para ampliar la informaci&oacute;n.</p>
                                                </td>
                                            </tr>

                                            <tr style="text-align: center;">
                                                <td style="padding: 36px 0;color:#153643;text-align: center;">
                                                    <p style="color: #007C8F;font-size: 14px;font-family:Arial,sans-serif;font-weight: 400;"><a href="<?= $urlFinal ?>" target="_blank" style="color: #007C8F;background-color: #007c8f;color: #fff;border: 2px solid #007c8f;border-radius: 5px;padding: 7px 30px;font-size: 18px;line-height: 1.5;transition: all 0.3s;text-decoration: none;">Ver presupuesto</a></p>
                                                </td>
                                            </tr>											
											
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                                                        <tr>
                                <td align="left" style="padding: 25px 0 25px 25px;background: #fff;padding: 25px 25px 5px 25px;background: #EFEFEF;">
                                    <p style="margin: 0;margin-bottom: 20px;font-size: 11px;font-family:Arial,sans-serif;font-weight: 300;color: #8F8F8F;">Este mail es enviado autom&aacute;ticamente. Por favor, no lo respondas.</p>
                                    <p style="margin: 0;margin-bottom: 20px;font-size: 11px;font-family:Arial,sans-serif;font-weight: 300;color: #8F8F8F;">Cualquier duda puede comunicarse al 0810 888 4000.</p>
                                    <p style="margin: 0;margin-bottom: 20px;font-size: 11px;font-family:Arial,sans-serif;font-weight: 300;color: #8F8F8F;">La informaci&oacute;n contenida en el presente correo y en sus adjuntos -en su caso- es confidencial y de uso exclusivo para los destinatarios del mismo. Si Ud. recibe este correo por error tenga bien notificar al emisor y eliminarlo. Esta prohibido a las personas o entidades que no sean los destinatarios de este correo cualquier tipo de modificaci&oacute;n, copia, distribuci&oacute;n, divulgaci&oacute;n, retenci&oacute;n o uso de la informaci&oacute;n que contiene.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>


</body></html>
<?php

	$HTMLoutput = utf8_encode( ob_get_contents() );
	ob_end_clean();
		
	return $HTMLoutput;	
		
}	


?>