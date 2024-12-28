<?



final class email extends field{

	function view(){
		return $this->value;
	}
	function bake_field (){
		return "<input  type=\"text\" class='span3' name=\"".$this->fieldname."\" id=\"".$this->fieldname."\" value=\"".trim($this->value)."\">";

		

						
	}
		
	function exec_add () {
		return $this->value;
	}
	function exec_edit () {
			return $this->value;
	}

}

