<?

final class color extends field{
 
	function view(){
		echo "<div style='background-color:#".$this->value.";width:15px;height:15px;'>&nbsp;</div>";
	}
	function bake_field (){		
		echo "<input class=\"color\" type=\"text\" cols=\"120\" id=\"".$this->fieldname."\" name=\"".$this->fieldname."\" value=\"".$this->value."\" >"; 

	
	}
		
	function exec_add () {
		
	}
	function exec_edit () {
	
	}

}

