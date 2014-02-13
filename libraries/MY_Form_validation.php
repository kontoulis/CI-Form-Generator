<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {
    
   public function __construct() {
        parent::__construct();
     $this->ci =& get_instance();
     $this->ci->config->load('validator');
     
   }
    
    public function set_rulesx($field, $label = '', $rules = '',$type="text",$options=array())
	{
		// No reason to set rules if we have no POST data
		/*if (count($_POST) == 0)
		{
			return $this;
		}*/

		// If an array was passed via the first parameter instead of indidual string
		// values we cycle through it and recursively call this function.
		if (is_array($field))
		{
			foreach ($field as $row)
			{
				// Houston, we have a problem...
				if ( ! isset($row['field']) OR ! isset($row['rules']))
				{
					continue;
				}

				// If the field label wasn't passed we use the field name
				$label = ( ! isset($row['label'])) ? $row['field'] : $row['label'];

				// Here we go!
				$this->set_rules($row['field'], $label, $row['rules']);
			}
			return $this;
		}

		// No fields? Nothing to do...
		if ( ! is_string($field) OR  ! is_string($rules) OR $field == '')
		{
			return $this;
		}

		// If the field label wasn't passed we use the field name
		$label = ($label == '') ? $field : $label;

		// Is the field name an array?  We test for the existence of a bracket "[" in
		// the field name to determine this.  If it is an array, we break it apart
		// into its components so that we can fetch the corresponding POST data later
		if (strpos($field, '[') !== FALSE AND preg_match_all('/\[(.*?)\]/', $field, $matches))
		{
			// Note: Due to a bug in current() that affects some versions
			// of PHP we can not pass function call directly into it
			$x = explode('[', $field);
			$indexes[] = current($x);

			for ($i = 0; $i < count($matches['0']); $i++)
			{
				if ($matches['1'][$i] != '')
				{
					$indexes[] = $matches['1'][$i];
				}
			}

			$is_array = TRUE;
		}
		else
		{
			$indexes	= array();
			$is_array	= FALSE;
		}

		// Build our master array
		$this->_field_data[$field] = array(
			'field'				=> $field,
			'label'				=> $label,
			'rules'				=> $rules,
			'is_array'			=> $is_array,
			'keys'				=> $indexes,
			'postdata'			=> NULL,
			'error'				=> '',
			'type'				=>$type,
                        'options'                       =>$options
		);
		
		return $this;
	}
        function print_form(){
	$form='';
        $form.=$this->ci->config->item('pre');
	foreach ($this->_field_data as $row)
			{
                           if($row['type']!="checkbox" && $row['type']!="radio" && $row['type']!="select"){
				$form.='<label for="'.$row['field'].'">'.$row['label'].'</label>';
                                $form.='<input type="'.$row['type'].'" name="'.$row['field'].'" class="'.$this->ci->config->item('input_class').'" />';	
                           }
                           else if($row['type']=="checkbox" || $row['type']=="radio"){
                             $form.='<div class="'.$row['type'].'">';
                             $form.='<label>';
                            $form.='<input type="'.$row['type'].'" value="" />';
                             $form.=$row['label'];
                             $form.='</label></div>';
                               
                           }else if($row['type']=="select"){
                               
                               $form.='<label for="'.$row['field'].'">'.$row['label'].'</label>';
                               $form.='<select class="form-control">';
                               foreach($row['options'] as $key => $value){
                                 $form.='<option value="'.$key.'">'.$value.'</option>';  
                               }
                                $form.='</select>';
                           }
			}
                        $form.=$this->ci->config->item('submit');
                        $form.=$this->ci->config->item('end');
			return $form;
	//return $this->_field_data;
	
	}
    
    
}
?>
