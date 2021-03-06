<?php 
/* 	
If you see this text in your browser, PHP is not configured correctly on this hosting provider. 
Contact your hosting provider regarding PHP configuration for your site.

PHP file generated by Adobe Muse CC 2017.0.1.363
*/

require_once('form_process.php');

$form = array(
	'subject' => 'Formulario Hoteleiro',
	'heading' => 'Envio de novo formulário',
	'success_redirect' => 'http://www.aqcez.com.br',
	'resources' => array(
		'checkbox_checked' => 'Marcado',
		'checkbox_unchecked' => 'Desmarcado',
		'submitted_from' => 'Formulário enviado do site: %s',
		'submitted_by' => 'Endereço IP do visitante: %s',
		'too_many_submissions' => 'Muitos envios recentes deste IP',
		'failed_to_send_email' => 'Falha no envio do email',
		'invalid_reCAPTCHA_private_key' => 'Chave privada do reCAPTCHA inválida.',
		'invalid_reCAPTCHA2_private_key' => 'Chave privada do reCAPTCHA 2.0 inválida.',
		'invalid_reCAPTCHA2_server_response' => 'Resposta do servidor reCAPTCHA 2.0 inválida.',
		'invalid_field_type' => 'Tipo de campo desconhecido \"%s\".',
		'invalid_form_config' => 'O campo \"%s\" possui uma configuração inválida.',
		'unknown_method' => 'Método de solicitação de servidor desconhecido'
	),
	'email' => array(
		'from' => 'eduardo@aqcez.com.br',
		'to' => 'eduardo@aqcez.com.br'
	),
	'fields' => array(
		'd' => array(
			'order' => 4,
			'type' => 'string',
			'label' => 'Segmento',
			'required' => true,
			'errors' => array(
				'required' => 'O campo \"Segemento\" é obrigatório.'
			)
		),
		'e' => array(
			'order' => 5,
			'type' => 'string',
			'label' => 'Nome',
			'required' => true,
			'errors' => array(
				'required' => 'O campo \"Nome\" é obrigatório.'
			)
		),
		'f' => array(
			'order' => 5,
			'type' => 'string',
			'label' => 'Empresa',
			'required' => true,
			'errors' => array(
				'required' => 'O campo \"Empresa\" é obrigatório.'
			)
		),
			
		'g' => array(
			'order' => 7,
			'type' => 'string',
			'label' => 'Telefone',
			'required' => true,
			'errors' => array(
				'required' => 'O campo \"Telefone\" é obrigatório.'
			)
		),
		'h' => array(
			'order' => 8,
			'type' => 'string',
			'label' => 'E-email',
			'required' => true,
			'errors' => array(
				'required' => 'O campo \"Email\" é obrigatório.'
			)
		),
		'i' => array(
			'order' => 9,
			'type' => 'string',
			'label' => 'Informações Adicionais',
			'required' => true,
			'errors' => array(
				'required' => 'O campo \"Informações ad\" é obrigatório.'
			)
		)
    )
);

process_form($form);
?>
