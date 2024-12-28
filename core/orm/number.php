<?

final class number extends field{

	function view(){
		return number_format($this->value,2,",",".");
	}
	function bake_field (){
		return "<input class=\"form-control\" type=\"text\" cols=\"120\" id=\"".$this->fieldname."\" name=\"".$this->fieldname."\" value=\"".$this->value."\" >"; 
	}
		
	function exec_add () {
		return $this->value;
	}
	function exec_edit () {
		return $this->value;	
	}

}

