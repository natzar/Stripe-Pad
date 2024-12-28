<?


final class text extends field
{

	function view()
	{
		if ($this->value != '')
			return  substr(strip_tags($this->value), 0, 100) . "...";
		return '';
	}
	function bake_field()
	{
		return "<textarea class=\"block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6\"  id=\"" . $this->fieldname . "\" name=\"" . $this->fieldname . "\"  >" . $this->value . "</textarea>";
	}

	function exec_add()
	{
		if ($this->value == '-1') return '';
		return addslashes(stripslashes($this->value));
	}
	function exec_edit()
	{
		if ($this->value == '-1') return '';
		if ($this->value != "")
			return addslashes(stripslashes($this->value));
		return '';
	}
}
