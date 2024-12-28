<?



final class literal extends field{

	function view(){
		return stripslashes($this->value);
	}
	function bake_field (){
                        
		return "<input name=\"".$this->fieldname."\" id=\"".$this->fieldname."\" value=\"".$this->value."\" type=\"text\"  placeholder=\"".$this->label."\" class=\"form-control\">                 ";
                      



		

						
	}
		
	function exec_add () {
	
		if ($this->value == -1) return '';
		return $this->value;
		return addslashes(htmlentities($this->value));

	}
	function exec_edit () {
		if ($this->value == -1) return '';
		return $this->value;
		return addslashes(htmlentities($this->value));
	}

}

