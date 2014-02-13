<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	
	$this->load->library('form_validation');
	
	//$valid= new CI_Validation();
                $options=array('0'=>'test0',
                                '1'=>'test1');
                $this->form_validation->set_rulesx('email', 'Email', 'required|valid_email','email');
		$this->form_validation->set_rulesx('first_name', 'Όνομα', 'required|xss_clean');
		$this->form_validation->set_rulesx('last_name', 'Επώνυμο', 'required|xss_clean');
                $this->form_validation->set_rulesx('counties', 'Νομός', 'required|xss_clean|callback_check_selection');
                $this->form_validation->set_rulesx('municipalities', 'Περιοχή', 'required|xss_clean|callback_check_selection');
                $this->form_validation->set_rulesx('location', 'Location', 'required|xss_clean','select',$options);
                $this->form_validation->set_rulesx('moto', 'Μότο', 'xss_clean');
		
                $this->form_validation->set_rulesx('epwnymia', 'Επωνυμία', 'required|xss_clean');
		$this->form_validation->set_rulesx('phone1', 'Τηλέφωνο', 'required|numeric|xss_clean|min_length[10]|max_length[10]|callback_phone_check');
                $this->form_validation->set_rulesx('fax', 'Fax', 'numeric|xss_clean|callback_fax_check');
                $this->form_validation->set_rulesx('kinito', 'Κινητό', 'required|numeric|xss_clean|min_length[10]|max_length[10]|callback_mobphone_check');
		$this->form_validation->set_rulesx('company', 'Εταιρεία', 'xss_clean');
		$this->form_validation->set_rulesx('password', 'Κωδικός', 'required','password');
		$this->form_validation->set_rulesx('password_confirm', 'Επιβεβαίωση Κωδικού', 'required','password');
                 $this->form_validation->set_rulesx('url1', 'Διέυθυνση Προφίλ', 'required|xss_clean');
                 $this->form_validation->set_rulesx('website_url', 'Προσωπική ιστοσελίδα', 'prep_url|callback_checkif_url');
                 $this->form_validation->set_rulesx('fb_url', 'Διεύθυνση στο Facebook', 'prep_url|callback_checkif_url');
                 $this->form_validation->set_rulesx('tw_url', 'Διεύθυνση στο Twitter', 'prep_url|callback_checkif_url');
                $this->form_validation->set_rulesx('recaptcha_response_field', 'lang:recaptcha_field_name', 'required|callback_check_captcha');
                $this->form_validation->set_rulesx('legal', 'lang:legal_notice', 'required','checkbox');
                $this->form_validation->set_rulesx('prosfora_profil', 'Προσφορά', 'xss_clean|max_length[250]');
                $this->form_validation->set_rulesx('about', 'Λίγα Λόγια για εσάς', 'xss_clean|max_length[250]');
                 $this->form_validation->set_rulesx('insutype', 'asfalistis', 'required','checkbox');
		 $config=array();
                 $config['pre']='<form class="form-horizontal" role="form"><div class="form-group">';
                 $config['end']='</div></form>';
                 $config['input_class']='form-control';
                 $config['submit']='<button type="submit" class="btn btn-primary">Submit</button>';
	$data['my_form']=$this->form_validation->print_form();
                $this->load->view('tmpl/header');
		$this->load->view('welcome_message',$data);
                $this->load->view('tmpl/footer');
                
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */