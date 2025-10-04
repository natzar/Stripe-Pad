<?php

final class fecha extends field
{

	function view()
	{
		if ($this->value != '')
			return time_elapsed_string($this->value);

		return $this->value;
	}
	function bake_field()
	{
		$date_value = $this->sql_to_fecha($this->value);
		if ($date_value == "") $date_value = $this->sql_to_fecha(date("Y-m-d H:i:s"), "/");
		return  "<input  class=\"block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6\" type=\"datetime-local\" cols=\"120\" id=\"" . $this->fieldname . "\" name=\"" . $this->fieldname . "\" value=\"" . $date_value . "\">";
	}

	function exec_add()
	{
		if ($this->fieldname == "updated") 		 return Date("Y-m-d H:i:s");
		return $this->fecha_to_sql($this->value, "-");
	}
	function exec_edit()
	{
		if ($this->fieldname == "updated") 		 return Date("Y-m-d H:i:s");
		return $this->fecha_to_sql($this->value, "-");
	}

	function fecha_to_sql($cadena, $separador_o = "-")
	{
		/*
echo $this->fieldname;
echo $this->value;
	if ($cadena != '' and $cadena != -1):
	return Date("Y-m-d H:i:s",strtotime($cadena));
	endif;
*/

		if ($cadena != '' and $cadena != -1):
			$aux = "";
			if (strstr($cadena, "T"))
				$aux = explode("T", $cadena);
			else
				$aux = explode(" ", $cadena);
			return $aux[0] . " " . $aux[1];
		endif;


		return Date("Y-m-d H:i:s");
	}

	function sql_to_fecha($cadena, $separador_o = "-")
	{
		if ($cadena != '' and $cadena != -1):
			$todo = explode(" ", $cadena);
			$fecha1 = $todo[0] . "T" . $todo[1];
			return $fecha1;
		endif;

		return Date("Y-m-d\TH:i:s");
	}

	/*

function fecha_to_sql($cadena,$separador_o){
//echo $this->fieldname;
//echo $this->value;

}

function sql_to_fecha($cadena,$separador_o){
	if ($cadena != ""){
		}
}
*/
}
