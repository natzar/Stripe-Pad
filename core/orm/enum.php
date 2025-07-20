<?php
final class enum extends field
{
    public array $options = []; // opciones posibles del ENUM

    function view()
    {
        if (!is_null($this->value)) return stripslashes($this->value);
        return "";
    }

    function bake_field()
    {
        $html = "<select name=\"" . $this->fieldname . "\" id=\"" . $this->fieldname . "\" class=\"block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6\">";

        foreach ($this->options as $opt) {
            $selected = ($opt == $this->value) ? "selected" : "";
            $html .= "<option value=\"" . htmlspecialchars($opt) . "\" $selected>" . htmlspecialchars($opt) . "</option>";
        }
        $html .= "</select>";
        return $html;
    }

    function exec_add()
    {
        //  if (!in_array($this->value, $this->options)) return '';
        return $this->value;
    }

    function exec_edit()
    {
        // if (!in_array($this->value, $this->options)) return '';
        return $this->value;
    }
}
