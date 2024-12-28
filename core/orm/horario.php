<?

final class horario extends field{
 
	function view(){
	   $aux = explode("|",$this->value);
        return $aux[0]." ".$aux[1];

	}
	function bake_field (){		
//	   $this->value = 
        $aux = array(-1,"");
    if ($this->value != ''){
        $aux = explode("|",$this->value);
        }
	   $field = "
<hr>
	   	      <div class='input-group'>
	   	      <label>Día de la semana</label>
	       <select class='form-control' id='".$this->fieldname."_dia' name='".$this->fieldname."[]'>
	       <option value='-1'>---</option>
	       <option value='1' "; 
	       if ($aux[0] == "1") $field .= "selected";
	       $field .= ">Lunes</option>
	       <option value='2' "; if ($aux[0] == "2" ) $field .= "selected";
	       $field .= ">Martes</option>
	       <option value='3' "; if ($aux[0] == "3") $field .= "selected";
	       $field .= ">Miércoles</option>
	       <option value='4' "; if ($aux[0] == "4" ) $field .= "selected";
	       $field .=">Jueves</option>
	       <option value='5' ";if ( $aux[0] == "5") $field .= "selected";
	       $field .=">Viernes</option>
	       <option value='6' "; if ($aux[0] == "6") $field .= "selected";
	       $field .=">Sábado</option>
	       <option value='7' "; if ($aux[0] == "7") $field .= "selected";
	       $field .=">Domingo</option>
	       </select>
	       

	       <div class=\"input-append bootstrap-timepicker\">
	       <label>Hora del día (24h)</label>
            <input class='form-control' id=\"".$this->fieldname."_hora\" name='".$this->fieldname."[]' type=\"text\" class=\"input-small\" value=\"".$aux[1]."\">
            <span class=\"add-on\"><i class=\"icon-time\"></i></span>
        </div>
        </div>
        
        
<hr>
	   ";
		return $field;
		// "<input class=\"color\" type=\"text\" cols=\"120\" id=\"".$this->fieldname."\" name=\"".$this->fieldname."\" value=\"".$this->value."\" >"; 

	
	}
		
	function exec_add () {
	   if ($this->value[0] != -1){
	       return $this->value[0]."|".$this->value[1];
	   }
	   return "";
	}
	function exec_edit () {
	   if ($this->value[0] != -1){
	   return $this->value[0]."|".$this->value[1];
	   }
	   return "";
	}

}

