<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */
class Subscribe extends Public_Controller
{
	protected $ADMIN_PATH;
	protected $SALES_EMAIL = 'Rizki.t@cepat.net.id, harri.ananto@cepat.net.id, ali@cepat.net.id, teguh.santoso@cepat.net.id';
	protected $TICKET_PREFIX = '10';
	
	protected $subscriber;
	protected $rules = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$this->ADMIN_PATH = base_url() . 'admin';
		
		$this->load->model('subscribe_m');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('alcopolis');
		
		// Set our validation rules
		$this->rules = $this->subscribe_m->_rules;
		$this->form_validation->set_rules($this->rules);
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		$this->form_validation->set_message('is_unique','You have been signed up with this %s');
	}	
	
	function render($view, $var = NULL){
		$this->template
		->title($this->module_details['name'])
		->append_css('module::subscribe.css')
		->append_js('module::subscribe.js')
		->set('subscriber', $this->subscriber)
		->set($var)
		->build($view);
	}
	
	
	public function index(){
		if($this->form_validation->run()){
			$db_fields = array('name', 'email', 'company', 'address', 'services', 'phone', 'mobile');
			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());
			$data['date'] = date('Y-m-d');
			
			if($this->subscribe_m->insert($data)){
				$id = intval($this->subscribe_m->get_id());
				
				//Ticket ID config
				$ticketid = $this->TICKET_PREFIX;
				
				if($id < 10){
					$ticketid .= '0' . $id;
				}else{
					$ticketid .= $id;
				}
				
				//send notification email to sales team
				$msg = '<table><tr><td>Name</td><td>: ' . $data['name'] . '</td></tr>';
				$msg .= '<tr><td>Company</td><td>: ' . $data['company'] . '</td></tr>';
				$msg .= '<tr><td>Interested in</td><td>: ' . $data['services'] . '</td></tr>';
				$msg .= '<tr><td>Address</td><td>: ' . $data['address'] . '</td></tr>';
				$msg .= '<tr><td>Email</td><td>: ' . $data['email'] . '</td></tr>';
				$msg .= '<tr><td>Telepon</td><td>: ' . $data['phone'] . '</td></tr>';
				$msg .= '<tr><td>Mobile</td><td>: ' . $data['mobile'] . '</td></tr></table>';
				

				$config = Array(
						'protocol' => "smtp",
						'smtp_host' => "mail.cepat.net.id",
						'smtp_port' => 25,
						'smtp_user' => "admin.cepatnet@cepat.net.id",
						'smtp_pass' => "R@chm4tTama22",
						'mailtype' => "html",
						'charset' => "iso-8859-1",
						'wordwrap' => "TRUE"
				);
				
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
					
				$this->email->from($data['email'], $data['name']);
				$this->email->to($this->SALES_EMAIL);
				//$this->email->to('myseconddigitalmail@yahoo.com, adriant.rivano@cepat.net.id');
				$this->email->cc('');
				$this->email->bcc('adriant.rivano@cepat.net.id');
					
				$this->email->subject('[ #' . $ticketid . ' ] Sales Inquiry');
				$this->email->message($msg);
					
				
				$this->email->send() ? redirect('subscribe/success') : redirect(current_url()); //$this->email->print_debugger();
			}
		}else{
			$this->subscriber = $this->subscribe_m->get_new();
			$this->template->set_layout('retail.html');
			$this->render('subscribe');
		}
	}
	
	public function success(){
		$this->render('success');
	}
}