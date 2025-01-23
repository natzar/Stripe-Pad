<?php

final class truefalse extends field{

	function view(){
		$output="";
		$output .= "<input type='checkbox' onchange='toggle_truefalse(\"".$this->table."\",\"".$this->fieldname."\",\"".$this->rid."\",this.checked);' name='".$this->fieldname."' id='".$this->fieldname."' value='1' ";
		if (!isset($this->value) or $this->value != 0) $output .= 'checked';
						$output .= ">";
        return $output;	
	}
	function bake_field (){
    	$output="";
		$output .= "<input type='checkbox' name='".$this->fieldname."' id='".$this->fieldname."' value='1' ";
		if (!isset($this->value) or $this->value != 0) $output .= 'checked';
						$output .= ">";
        return $output;	
						
						
	}
		
	function exec_add () {
		if ($this->value < 0) $this->value = 0;
		return $this->value;
	}
	
	function exec_edit () {
		if ($this->value < 0) $this->value = 0;
		return $this->value;	
	}

}

