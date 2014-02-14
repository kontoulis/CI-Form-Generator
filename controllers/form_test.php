<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form_test extends CI_Controller {

    /**
     * This controller demonstrates the usage of the extended form validation
	 * Notice that we are using set_rulesx() instead of set_rules()
     */
    public function index() {

        $this->load->library('form_validation');

        
        $select = array(' ' => 'Select...',
            '0' => 'test0',
            '1' => 'test1',
            '2' => 'test2',
            '3' => 'test3');
			
			//adding the 'checked' => 'checked' key-value pair will cause the following radion to be checked
			
        $radio = array(
            '1' => 'text1',
            'checked' => 'checked',
            '2' => 'text2',
            '3' => 'text3',
            '4' => 'text4'
        );
		
		//similar to the radio, here you have to use only the value as 'checked' and the next checkbox will be checked
		
        $checkbox = array(
            '1' => 'text1',
            'checked1' => 'checked',
            '2' => 'text2',
            '3' => 'text3',
            'checked2' => 'checked',
            '4' => 'text4'
        );
        $textarea = array(
            'placeholder' => 'test textarea...',
            'rows' => '3',
            'columns' => '6'
        );
        
        // Function set_rulesx($field, $label = '', $rules = '', $type = "text", $options = array())
        // You can add the type argument i fyour input is not type of text, plus the options as it is performed bellow
        
        $this->form_validation->set_rulesx('email', 'Email', 'required|valid_email', 'email');
        $this->form_validation->set_rulesx('password', 'Paasword', 'required', 'password');
        $this->form_validation->set_rulesx('password_confirm', 'Confirm Password', 'required', 'password');
        $this->form_validation->set_rulesx('first_name', 'First Name', 'required|xss_clean');
        $this->form_validation->set_rulesx('last_name', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rulesx('counties', 'Νομός', 'required|xss_clean|callback_check_selection');
        $this->form_validation->set_rulesx('municipalities', 'Περιοχή', 'required|xss_clean|callback_check_selection');
        $this->form_validation->set_rulesx('select', 'Select', 'required|xss_clean', 'select', $select);

      

        $this->form_validation->set_rulesx('checkbox', 'Checkbox', 'required', 'checkbox', $checkbox);
        $this->form_validation->set_rulesx('radio', 'Radio', 'xss_clean', 'radio', $radio);
        $this->form_validation->set_rulesx('textarea', 'Textarea', 'max_length[200]', 'textarea', $textarea);
        
        //example configuration array if you need to override any setting
        //But better prefer to change the config/validator.php file
        $config = array();
        $config['pre'] = '<form class="form-horizontal" role="form"><div class="form-group">';
        $config['end'] = '</div></form>';
        $config['input_class'] = 'form-control';
        $config['submit'] = '<button type="submit" class="btn btn-primary">Submit</button>';
        
        // Passsing the print_form result in $data array and print it in view.
        $data['my_form'] = $this->form_validation->print_form();
        $this->load->view('tmpl/header');
        $this->load->view('form_view', $data);
        $this->load->view('tmpl/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */