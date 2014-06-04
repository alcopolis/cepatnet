<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Plugin_Alcopolis extends Plugin
{
	public $version = '1.0.0';

	public $name = array(
		'en'	=> 'Alcopolis Plugin'
	);

	public $description = array(
		'en'	=> ''
	);

	public function _self_doc()
	{
		$info = array(
			'site_status' => array(
				'description' => array(// a single sentence to explain the purpose of this method
					'en' => ''
				),
				'single' => true,// will it work as a single tag?
				'double' => false,// how about as a double tag?
				'variables' => '',// list all variables available inside the double tag. Separate them|like|this
			),
			
			'contact' => array(// the name of the method you are documenting
					'description' => array(// a single sentence to explain the purpose of this method
							'en' => 'Display a contact form anywhere on your site. Each wildcard attribute that you pass ("email" for example) is available as a variable in the email template and between the double tags to output the form field.'
					),
					'single' => false,// will it work as a single tag?
					'double' => true,// how about as a double tag?
					'variables' => 'name|email|subject|message|attachment-file|some-hidden-value',// list all variables available inside the double tag. Separate them|like|this
					'attributes' => array(
							'name' => array(
									'type' => 'text',
									'flags' => 'text|required',
									'default' => '',
									'required' => false,
							),
							'email' => array(
									'type' => 'text',
									'flags' => 'text|required|valid_email',
									'default' => '',
									'required' => false,
							),
							'subject' => array(
									'type' => 'text',
									'flags' => 'dropdown|required|value=Name|another=Another Name',
									'default' => '',
									'required' => false,
							),
							'message' => array(
									'type' => 'text',
									'flags' => 'textarea|required|trim',
									'default' => '',
									'required' => false,
							),
							'some-hidden-value' => array(
									'type' => 'text',
									'flags' => 'hidden|=a hidden value',
									'default' => '',
									'required' => false,
							),
							'attachment-file' => array(
									'type' => 'text',
									'flags' => 'file|jpg|png|zip',
									'default' => '',
									'required' => false,
							),
							'max-size' => array(
									'type' => 'number',
									'flags' => '',
									'default' => '10000',
									'required' => false,
							),
							'button' => array(
									'type' => 'text',
									'flags' => '',
									'default' => 'Send',
									'required' => false,
							),
							'template' => array(
									'type' => 'slug',
									'flags' => '',
									'default' => 'contact',
									'required' => false,
							),
							'lang' => array(
									'type' => 'text',
									'flags' => '',
									'default' => 'en',
									'required' => false,
							),
							'to' => array(
									'type' => 'text',
									'flags' => '',
									'default' => Settings::get('contact_email'),
									'required' => false,
							),
							'from' => array(
									'type' => 'text',
									'flags' => '',
									'default' => Settings::get('server_email'),
									'required' => false,
							),
							'sent' => array(
									'type' => 'text',
									'flags' => '',
									'default' => 'Your message has been sent. We will get back to you as soon as we can.',
									'required' => false,
							),
							'error' => array(
									'type' => 'text',
									'flags' => '',
									'default' => 'There was a problem sending this message. Please try again later.',
									'required' => false,
							),
							'auto-reply' => array(
									'type' => 'text',
									'flags' => 'autoreply-template',
									'default' => '',
									'required' => false,
							),
							'success-redirect' => array(
									'type' => 'text',
									'flags' => '',
									'default' => 'the current uri',
									'required' => false,
							),
							'action' => array(
									'type' => 'text',
									'flags' => '',
									'default' => 'the current uri string',
									'required' => false,
							),
					),
			),
		);
	
		return $info;
	}

	
	
	public function __construct()
	{
		
	}
	
	
	function site_status()
	{
		if(!$this->settings->frontend_enabled){
			if($this->current_user != NULL && $this->current_user->group == 'admin'){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
		
		return 'asdfasdfasd';
	}
	
	
	public function contact()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
	
		$field_list = $this->attributes();
	
		// If they try using the old form tag plugin give them an idea why it's failing.
		if ( ! $this->content() or count($field_list) == 0)
		{
			return 'The new contact plugin requires field parameters and it must be used as a double tag.';
		}
	
		$button             = $this->attribute('button', 'send');
		$template           = $this->attribute('template', 'contact');
		$autoreply_template = $this->attribute('auto-reply', false);
		$lang               = $this->attribute('lang', Settings::get('site_lang'));
		$to                 = $this->attribute('to', Settings::get('contact_email'));
		$from               = $this->attribute('from', Settings::get('server_email'));
		$reply_to           = $this->attribute('reply-to');
		$max_size           = $this->attribute('max-size', 10000);
		$redirect           = $this->attribute('success-redirect', false);
		$action             = $this->attribute('action', current_url());
		$form_meta          = array();
		$validation         = array();
		$output             = array();
		$dropdown           = array();
	
		// unset all attributes that are not field names
		unset($field_list['button'],
				$field_list['template'],
				$field_list['auto-reply'],
				$field_list['lang'],
				$field_list['to'],
				$field_list['from'],
				$field_list['reply-to'],
				$field_list['max-size'],
				$field_list['redirect'],
				$field_list['action']
		);
	
		foreach ($field_list as $field => $rules)
		{
			$rule_array = explode('|', $rules);
				
			// Take the simplified form names and turn them into the real deal
			switch ($rule_array[0]) {
				case '':
					$form_meta[$field]['type'] = 'input';
					break;
				case 'text':
					$form_meta[$field]['type'] = 'input';
					break;
	
				case 'textarea':
					$form_meta[$field]['type'] = 'textarea';
					break;
						
				case 'dropdown':
					$form_meta[$field]['type'] = 'dropdown';
						
					// In this case $rule_array holds the dropdown key=>values and possibly the "required" rule.
					$values = $rule_array;
					// get rid of the field type
					unset($values[0]);
						
					// Is a value required?
					if ($required_key = array_search('required', $values))
					{
						$other_rules = 'required';
						unset($values[$required_key]);
					}
					else
					{
						// Just set something
						$other_rules = 'trim';
					}
	
					// Build the array to pass to the form_dropdown() helper
					foreach ($values as $item)
					{
						$item = explode('=', $item);
						// If they didn't specify a key=>value (example: name=Your Name) then we'll use the value for the key also
						$dropdown[$item[0]] = (count($item) > 1) ? $item[1] : $item[0];
					}
						
					$form_meta[$field]['dropdown'] = $dropdown;
					// we need to empty the array else we'll end up with all values appended
					$dropdown = array();
					break;
	
				case 'file':
					$form_meta[$field]['type'] = 'upload';
						
					$config = $rule_array;
					// get rid of the field type
					unset($config[0]);
						
					// If this attachment is required add that to the rules and unset it from upload config
					if ($required_key = array_search('required', $config))
					{
						if ( ! self::_require_upload($field))
						{
							// We'll set this so validation will fail and our message will be shown
							$other_rules = 'required';
						}
						unset($config[$required_key]);
					}
					else
					{
						$other_rules = 'trim';
					}
						
					// set configs for file uploading
					$form_meta[$field]['config']['allowed_types'] = implode('|', $config);
					$form_meta[$field]['config']['max_size'] = $max_size;
					$form_meta[$field]['config']['upload_path'] = UPLOAD_PATH.'contact_attachments';
					break;
	
				case 'hidden':
					$form_meta[$field]['type'] = 'hidden';
					$value = preg_split('/=/',$rule_array[1]);
					$value = $value[1];
					$form_meta[$field]['value'] = $value;
						
					break;
			}
	
			$validation[$field]['field'] = $field;
			$validation[$field]['label'] = humanize($field);
			$validation[$field]['rules'] = ($rule_array[0] == 'file' or $rule_array[0] == 'dropdown') ? $other_rules : implode('|', $rule_array);
		}
	
	
		if ($this->input->post('contact-submit')) {
				
			$this->form_validation->set_rules($validation);
				
			if ($this->form_validation->run())
			{
				// maybe it's a bot?
				if ($this->input->post('d0ntf1llth1s1n') !== ' ')
				{
					$this->session->set_flashdata('error', lang('contact_submit_error'));
					redirect(current_url());
				}
	
				$data = $this->input->post();
	
				// Add in some extra details about the visitor
				$data['sender_agent'] = $this->agent->browser() . ' ' . $this->agent->version();
				$data['sender_ip']    = $this->input->ip_address();
				$data['sender_os']    = $this->agent->platform();
				$data['slug']         = $template;
				
				// they may have an email field in the form. If they do we'll use that for reply-to.
				$data['reply-to'] = (empty($reply_to) and isset($data['email'])) ? $data['email'] : $reply_to;
	
				$data['from']     = $from;
				
				//Switch email recepient based on subject
				switch($data['subject']){
					case 'Customer Service' :
						$data['to'] = 'noc@cepat.net.id, noc@moratelindo.co.id, cs@moratelindo.co.id';
						break;
							
					case 'Technical' :
						$data['to'] = 'noc@cepat.net.id, noc@moratelindo.co.id, cs@moratelindo.co.id, leaders.cts@cepat.net.id';
						break;
				
					case 'Feedback' :
						$data['to'] = 'noc@cepat.net.id, cs@moratelindo.co.id';
						break;
				
					case 'Sales Inquiry' :
						$data['to'] = 'Rizki.t@cepat.net.id, harri.ananto@cepat.net.id, ali@cepat.net.id, teguh.santoso@cepat.net.id';
						break;
				
					default:
						$data['to'] = 'noc@cepat.net.id, cs@moratelindo.co.id';
						break;
				}
				
				
				
				// Yay they want to send attachments along
				if ($_FILES > '')
				{
					$this->load->library('upload');
					is_dir(UPLOAD_PATH.'contact_attachments') OR @mkdir(UPLOAD_PATH.'contact_attachments', 0777);
						
					foreach ($_FILES as $form => $file)
					{
						if ($file['name'] > '')
						{
							// Make sure the upload matches a field
							if ( ! array_key_exists($form, $form_meta)) break;
	
							$this->upload->initialize($form_meta[$form]['config']);
							$this->upload->do_upload($form);
								
							if ($this->upload->display_errors() > '')
							{
								$this->session->set_flashdata('error', $this->upload->display_errors());
								redirect(current_url());
							}
							else
							{
								$result_data = $this->upload->data();
								// pass the attachment info to the email event
								$data['attach'][$result_data['file_name']] = $result_data['full_path'];
							}
						}
					}
				}
	
				// Try to send the email
				$success = $this->_send_email($data);
				
				if($success){
					redirect( ($redirect ? $redirect : current_url()) );
				}
				
			}	//End form validation run()
		}
	
		// From here on out is form production
		$parse_data = array();
		foreach ($form_meta as $form => $value)
		{
			$parse_data[$form]  = form_error($form, '<div class="'.$form.'-error error">', '</div>');
				
			if ($value['type'] == 'dropdown')
			{
				$parse_data[$form] .= call_user_func('form_'.$value['type'],
						$form,
						$form_meta[$form]['dropdown'],
						set_value($form),
						'id="contact_'.$form.'" class="'.$form.'"'
				);
			}
			elseif($value['type'] == 'hidden')
			{
				$parse_data[$form] .= call_user_func('form_'.$value['type'],
						$form,
						$value['value'],
						'class="'.$form.'"'
				);
			}
			else
			{
				$parse_data[$form] .= call_user_func('form_'.$value['type'],
						$form,
						set_value($form),
						'id="contact_'.$form.'" class="'.$form.'"'
				);
			}
		}
	
		$output	 = form_open_multipart($action, 'class="contact-form"').PHP_EOL;
		$output	.= form_input('d0ntf1llth1s1n', ' ', 'class="default-form" style="display:none"');
		$output	.= $this->parser->parse_string($this->content(), str_replace('{{', '{ {', $parse_data), true).PHP_EOL;
		$output .= '<span class="contact-button">'.form_submit('contact-submit', ucfirst($button)).'</span>'.PHP_EOL;
		$output .= form_close();
	
		return $output;
	}
	
	
	public function _require_upload($field)
	{
		if ( isset($_FILES[$field]) and $_FILES[$field]['name'] > '')
		{
			return true;
		}
		return false;
	}
	
	
	private function _send_email($data) {
		$config = Array(
				'protocol' => "smtp",
				'smtp_host' => "mail.cepat.net.id",
				'smtp_port' => 25,
				'smtp_user' => "admin.cepatnet@cepat.net.id",
				'smtp_pass' => "cepatnet",
				'mailtype' => "html",
				'charset' => "utf-8",
				'wordwrap' => "TRUE"
		);
	
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		$this->email->from($data['from']);
		$this->email->to($data['to']);
		$this->email->subject($data['subject']);
		$this->email->message($data['message']);
		

		return $this->email->send();
	}
	
}

/* End of file example.php */