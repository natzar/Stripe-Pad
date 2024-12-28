<?

final class password extends field{

	function view(){
		return "Password encriptado";
	}
	function bake_field (){
	
			return "<input type=\"text\" cols=\"120\" id=\"".$this->fieldname."\" name=\"".$this->fieldname."\" value=\"\"><BR>Se sobre-escribir&aacute; el password anterior."; 
					
					
					
	}
		
	function exec_add () {
		if ($this->value != -1)
		return sha1(strtolower($this->value));
		return '';
		
	}
	function exec_edit () {

			if ($this->value != -1){
							//echo 'edit password'.$this->value;
										return sha1(strtolower($this->value)); 
			}

			
			return '';
		
	}

}

