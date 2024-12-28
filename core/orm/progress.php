<?



final class progress extends field{

	function view(){
		return '
		<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="'.$this->value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$this->value.'%;">
    '.$this->value.'%
  </div>
</div>
';
		
	}
	function bake_field (){
if ($this->value == "")$this->value = 0;
		return "<input name=\"".$this->fieldname."\" id=\"".$this->fieldname."\" value=\"".$this->value."\" type=\"range\" max=\"100\" min=\"0\" step=\"1\" placeholder=\"".$this->label."\" class=\"form-control\">                 ";
                      



		

						
	}
		
	function exec_add () {
	
		if ($this->value == -1) return '';
		return $this->value;
		return addslashes(htmlentities($this->value));

	}
	function exec_edit () {
		if ($this->value == -1) return '';
		return $this->value;
		return addslashes(htmlentities($this->value));
	}

}

