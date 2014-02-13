<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_test extends CI_Controller {


	public function index()
	{
	
	$this->load->library('form_validation');
	

                $options=array('0'=>'test0',
                                '1'=>'test1');
              $radio=array(
                  '1'=>'text1',
                  'checked'=>'checked',
                  '2'=>'text2'
              );
                $this->form_validation->set_rulesx('email', 'Email', 'required|valid_email','email');
		$this->form_validation->set_rulesx('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rulesx('last_name', 'Last Name', 'required|xss_clean');
                $this->form_validation->set_rulesx('counties', 'Νομός', 'required|xss_clean|callback_check_selection');
                $this->form_validation->set_rulesx('municipalities', 'Περιοχή', 'required|xss_clean|callback_check_selection');
                $this->form_validation->set_rulesx('select', 'Select', 'required|xss_clean','select',$options);
                
		$this->form_validation->set_rulesx('password', 'Paasword', 'required','password');
		$this->form_validation->set_rulesx('password_confirm', 'Confirm Password', 'required','password');
             
                $this->form_validation->set_rulesx('checkbox', 'Checkbox', 'required','checkbox');
                $this->form_validation->set_rulesx('radio', 'Radio', 'xss_clean','radio',$radio);
               
		 $config=array();
                 $config['pre']='<form class="form-horizontal" role="form"><div class="form-group">';
                 $config['end']='</div></form>';
                 $config['input_class']='form-control';
                 $config['submit']='<button type="submit" class="btn btn-primary">Submit</button>';
	$data['my_form']=$this->form_validation->print_form();
	$data['my_form']=$this->form_validation->print_form();
                $this->load->view('tmpl/header');
		$this->load->view('form_view',$data);
                $this->load->view('tmpl/footer');
                
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */