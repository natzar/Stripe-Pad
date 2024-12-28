<?


final  class tinymce extends field{

	function view(){
		return  substr(strip_tags(		 stripslashes($this->value)),0,100)."...";
	}
	function bake_field (){
		return "<textarea  class='text-editor'  id=\"".$this->fieldname."\" name=\"".$this->fieldname."\"  >".stripslashes($this->value)."</textarea>";
					
	}
		
	function exec_add () {
//		return	mysql_real_escape_string($this->value);
		
		if ($this->value == -1) return '';
		return addslashes($this->value);
		return (htmlentities($this->value));		
	}
	function exec_edit () {
//			return	mysql_real_escape_string($this->value);
		if ($this->value == -1) return '';
				return addslashes($this->value);
			return htmlentities($this->value);
	}

}

							