<?php

final class number extends field
{

	function view()
	{
		return number_format($this->value, 2, ",", ".");
	}
	function bake_field()
	{
		return "<input  class=\"block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6\" type=\"text\" cols=\"120\" id=\"" . $this->fieldname . "\" name=\"" . $this->fieldname . "\" value=\"" . $this->value . "\" >";
	}

	function exec_add()
	{
		return $this->value;
	}
	function exec_edit()
	{
		return $this->value;
	}
}
