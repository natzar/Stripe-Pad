<?php

final class time_spent extends field{
 
	function view(){
		if ($this->value > 0){
			return $this->value;
		}else{
			return '<span style="border:3px solid red">'.$this->value.'</span>';
		}

	}
	function bake_field (){		
		return "<input class=\"form-control\" type=\"number\" style=\"border:2px solid red\" cols=\"120\" id=\"".$this->fieldname."\" name=\"".$this->fieldname."\" value=\"".$this->value."\" >"; 

	
	}
		
	function exec_add () {
		return $this->value;
	}
	function exec_edit () {
		return $this->value;
	}

}

