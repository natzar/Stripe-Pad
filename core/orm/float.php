<?php

final class float_number extends field{

	function view(){
		return number_format( floatval($this->value),2,",",".");

	}
	function bake_field (){
		echo "<input class=\"text-input medium-input\" type=\"text\" cols=\"120\" id=\"".$this->fieldname."\" name=\"".$this->fieldname."\" value=\"";
		$aux = number_format(floatval($this->value),2,',','.');
		if ($aux != "0,00") echo $aux;
		echo "\">";
	}
		
	function exec_add () {
		return float_to_sql($this->value);
	}
	function exec_edit () {
		if ($this->value != "" and $this->value != "0,00")
			return float_to_sql($retrieved);
			
		return '0.00';

	}

}



