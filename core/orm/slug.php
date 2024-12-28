<?

final class slug extends field{

	function view(){
		return $this->value;
	}
	function bake_field (){
		$out = '';


		
		$label = $this->table == 'courses' ? 'programs':$this->table;	
		return "<input  type=\"text\"  onChange=\"validateSlug('".$this->fieldname."');\" name=\"".$this->fieldname."\" id=\"".$this->fieldname."\" class=\"form-control\" value=\"".trim($this->value)."\">".$out;

		
	}
		
	function exec_add () {
		return $this->value;
	}
	function exec_edit () {
		return $this->value;	
	}

}



