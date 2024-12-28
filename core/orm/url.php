<?

final class url extends field{

	function view(){
	if (empty($this->value) or $this->value == -1) return '';
		return "<a href='".$this->value."' target='_blank'>URL</a>";
	}
	function bake_field (){
		return "<input  type=\"text\" class='form-control' name=\"".$this->fieldname."\" id=\"".$this->fieldname."\" value=\"".trim($this->value)."\" placeholder=\"http://\">";

		
	}
		
	function exec_add () {
		return $this->value;
	}
	function exec_edit () {
		return $this->value;	
	}

}

