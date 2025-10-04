<?php

final class temperature extends field{
 
	function view(){
		return  "<div style='background-color:#".$this->value.";width:15px;height:15px;'>".$this->value."</div>";
	}
	function bake_field (){		
		return "<input class=\"\" type=\"hidden\" cols=\"120\" id=\"".$this->fieldname."\" name=\"".$this->fieldname."\" value=\"".$this->value."\" >"; 

	
	}
		
	function exec_add () {
		return $this->value;	
	}
	function exec_edit () {
		return $this->value;
	}

}

