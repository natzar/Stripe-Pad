<?

final class featured extends field{

	function view(){
		$output="";
		$output .= "<input type='checkbox' onchange='toggle_featured(\"".$this->table."\",\"".$this->rid."\",this.checked);' name='".$this->fieldname."' id='".$this->fieldname.$this->rid."' value='1' ";
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
		return $this->value;
	}
	function exec_edit () {
		return $this->value;	
	}

}

