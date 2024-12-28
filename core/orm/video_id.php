<?



final class video_id extends field{

	function view(){
		return $this->value;
	}
	function bake_field (){
		return "<p>Introduce el texto que aparece en la url.<br><input  type=\"text\" class='span3' name=\"".$this->fieldname."\" id=\"".$this->fieldname."\" value=\"".trim($this->value)."\"><br><img src=\"views/img/video.png\">";

		

						
	}
		
	function exec_add () {
		return addslashes(stripslashes($this->value));

	}
	function exec_edit () {
		return addslashes(stripslashes($this->value));
	}

}

