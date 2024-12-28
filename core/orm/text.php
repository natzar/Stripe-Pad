<?


final class text extends field{

	function view(){
	if ($this->value != '')
		return  substr(strip_tags($this->value),0,100)."...";
		return '';
	}
	function bake_field (){
		return "<textarea class='form-control col-lg-6'  id=\"".$this->fieldname."\" name=\"".$this->fieldname."\"  >".$this->value."</textarea>";
	}
		
	function exec_add () {
			if ($this->value == '-1') return '';
			return addslashes(stripslashes($this->value));

	}
	function exec_edit () {
		if ($this->value == '-1') return '';
		if ($this->value != "")
				return addslashes(stripslashes($this->value));
		return '';
	}

}

							