<?php

final class truefalse extends field
{

	function view()
	{
		$output = "";
		// $output .= "<input type='checkbox' onchange='toggle_truefalse(\"" . $this->table . "\",\"" . $this->fieldname . "\",\"" . $this->rid . "\",this.checked);' name='" . $this->fieldname . "' id='" . $this->fieldname . "' value='1' ";
		if ($this->value == 1) $output .= 'Activo';
		else
			$output .= "Desactivado";
		return $output;
	}
	function bake_field()
	{
		$output = "";
		$output .= "<label class='block items-center space-x-2 cursor-pointer'>";
		$output .= "<input type='checkbox' name='" . $this->fieldname . "' id='" . $this->fieldname . "' value='1' class='form-checkbox h-5 w-5 text-indigo-600 transition duration-150 ease-in-out '";
		if (!isset($this->value) or $this->value != 0) $output .= ' checked';
		$output .= ">";
		$output .= "<span class='text-gray-700 text-xs'>" . ucfirst($this->fieldname) . "</span>";
		$output .= "</label>";

		return $output;
	}

	function exec_add()
	{
		if ($this->value < 0) $this->value = 0;
		return $this->value;
	}

	function exec_edit()
	{
		if ($this->value < 0) $this->value = 0;
		return $this->value;
	}
}
