<?

final class fechahora extends field
{

	function view()
	{
		if ($this->value != '')
			return time_elapsed_string($this->value);
		return $this->sql_to_fecha($this->value, "-");




		return $this->value;
	}
	function bake_field()
	{
		$date_value = $this->sql_to_fecha($this->value, "/");
		if ($date_value == "") $date_value = $this->sql_to_fecha(date("Y-m-d"), "/");
		return  "<input  class=\"block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6\" type=\"text\" cols=\"120\" id=\"" . $this->fieldname . "\" name=\"" . $this->fieldname . "\" value=\"" . $date_value . "\">";
	}

	function exec_add()
	{
		if ($this->value != "") return $this->fecha_to_sql($this->value, "/");
		return '0000-00-00';
	}
	function exec_edit()
	{
		if ($this->value != "")
			return $this->fecha_to_sql($this->value, "/");

		return '0000-00-00';
	}

	function fecha_to_sql($cadena, $separador_o)
	{
		//echo $this->fieldname;
		//echo $this->value;
		if ($cadena != '' and $cadena != -1):
			$aux = explode(" ", $cadena);

			$fech = explode($separador_o, $aux[0]);
			$dia = $fech[0];
			$mes = $fech[1];
			$anno = $fech[2];

			$fecha1 = $anno . "-" . $mes . "-" . $dia;
			return $fecha1;
		endif;
		return '';
	}

	function sql_to_fecha($cadena, $separador_o)
	{
		if ($cadena != "") {
			$todo = explode(" ", $cadena);

			$fech = explode("-", $todo[0]);
			$dia = $fech[2];
			$mes = $fech[1];
			$anno = $fech[0];

			if (!isset($todo[1])) return $dia . $separador_o . $mes . $separador_o . $anno;

			$fecha1 = $dia . $separador_o . $mes . $separador_o . $anno . " " . $todo[1];
			return $fecha1;
		}
	}
}
