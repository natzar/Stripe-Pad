<?php



final class literal extends field
{

	function view()
	{
		if (!is_null($this->value))	return stripslashes($this->value);
		return "";
	}
	function bake_field()
	{

		return "<input name=\"" . $this->fieldname . "\" id=\"" . $this->fieldname . "\" value=\"" . $this->value . "\" type=\"text\"  placeholder=\"" . $this->label . "\" class=\"block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6\">                 ";
	}

	function exec_add()
	{

		if ($this->value == -1) return '';
		return $this->value;
		return addslashes(htmlentities($this->value));
	}
	function exec_edit()
	{
		if ($this->value == -1) return '';
		return $this->value;
		return addslashes(htmlentities($this->value));
	}
}
