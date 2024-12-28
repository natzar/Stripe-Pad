<?



final class disabled extends field{

	function view(){
		return $this->value;
	}
	function bake_field (){
		return "<input  type=\"text\" class='span3 disabled' name=\"".$this->fieldname."\" id=\"".$this->fieldname."\" value=\"".trim($this->value)."\" enabled='false' >";

		

						
	}
		
	function exec_add () {
		return ($this->value);

	}
	function exec_edit () {
		return $this->value;
	}

}

