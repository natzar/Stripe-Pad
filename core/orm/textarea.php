<?php


final class textarea extends field{

	function view(){
	if ($this->value != '')
		return  substr(strip_tags($this->value),0,100)."...";
		return '';
	}
	function bake_field (){
		return "<textarea class='form-control text-editor col-lg-6'  id=\"".$this->fieldname."\" name=\"".$this->fieldname."\"  >".$this->value."</textarea>";
	}
		
	function exec_add () {
			if ($this->value == '-1') return '';
			return addslashes(strip_tags(stripslashes($this->value),'<br><img></br><br/><p><ul><li><strong><video>'));

	}
	function exec_edit () {
		if ($this->value == '-1') return '';
		if ($this->value != "") return addslashes(strip_tags(stripslashes($this->value),'<br><img></br><br/><p><ul><li><strong><video>'));
	}

}

							