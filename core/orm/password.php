<?

final class password extends field
{

	function view()
	{
		return "Password encriptado";
	}
	function bake_field()
	{

		return "<input type=\"text\"  class=\"block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6\" cols=\"120\" id=\"" . $this->fieldname . "\" name=\"" . $this->fieldname . "\" value=\"\"><BR>Se sobre-escribir&aacute; el password anterior.";
	}

	function exec_add()
	{
		if ($this->value != -1)
			return  hash('sha256', $this->value);
		return '';
	}
	function exec_edit()
	{

		if ($this->value != -1) {

			return  hash('sha256', $this->value);
		}


		return '';
	}
}
