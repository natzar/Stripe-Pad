<?


final class tags extends field{
	protected $db;
	function view(){
	if ($this->value != -1)
		return $this->value;
	else return '';
	}
	function bake_field (){
				

							$output = "";
							$this->db = SPDO::singleton();			
							$data = $this->db->prepare("SELECT tags FROM ".$this->table);
							$LIST = array();
							$data->execute();
							$aux = $data->fetchAll();
							
							foreach ($aux as $camp_tag) { 
							if (strstr($camp_tag['tags'],",")){
							$aux = explode(",",$camp_tag['tags']);
							for ($ie = 0;$ie < count($aux);$ie++) if ($aux[$ie] != "") $LIST[] = trim($aux[$ie]);
							} else {
							$LIST[] = trim($camp_tag['tags']);
							}
							}
							$PUNTS = array();
							for ($ie = 0;$ie < count($LIST);$ie++){
								if ($LIST[$ie] != ""){
									if (!isset($PUNTS[$LIST[$ie]])) $PUNTS[$LIST[$ie]]=1;
									else  $PUNTS[$LIST[$ie]]++;
								}
							}
							arsort($PUNTS);
										
					$output .= "<input class=\"input span6\" type=\"text\" cols=\"120\" name=\"".$this->fieldname."\" id=\"".$this->fieldname."\" value=\"".$this->value."\">"; 
												$output .= "(Separados por comas y sin espacios)";
							$output .= "<br>";
							$y = 0;
							foreach($PUNTS as $key => $value){
							if ($y > 0) $output .= ", ";
			                       $output .= "<a class='badge' href='javascript:click_tag(\"$key\");'>$key</a> ";
                       
		                       $y++;
               			    }							
							
							
							
							
							
							
				
					return $output;
	}
		
	function exec_add () {
		if (substr($this->value,strlen($this->value)-1,strlen($this->value)) == ',') $this->value = substr($this->value,0,strlen($this->value)-1);

		//echo  addslashes(stripslashes($this->value));
		return addslashes(stripslashes($this->value)); 
	}
	function exec_edit () {
		if (substr($this->value,strlen($this->value)-1,strlen($this->value)) == ',') $this->value = substr($this->value,0,strlen($this->value)-1);
						return addslashes(stripslashes($this->value));
		return ''; 
	}

}

