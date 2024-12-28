<?

final class multiselect extends field{

	function view(){
		if ($this->value != ''){
			$uxa = explode(",",$this->value);
			$o = '';
			$f_fieldname = str_replace("Id","",$this->fieldname);
			$i = 0;
			foreach($uxa as $a):
				if ($i > 0) $o .= ",";			
				$o .= $this->giveme($f_fieldname,$f_fieldname,$a);

				$i++;
			endforeach; 
		return $o;
		}

		return '';
	
	}
	function bake_field (){
	$f_fieldname = str_replace("Id","",$this->fieldname);
		return $this->bake_multicombo($this->config->get('db_prefix').$f_fieldname,$f_fieldname,$this->value);				
						
	}
		
	function exec_add () {
		if (is_array($this->value))
		return implode(",",$this->value);
		return '';

	}
	function exec_edit () {

		if (is_array($this->value))
		return 	implode(",",$this->value);
				return '';
	}
	
	
	function bake_multicombo($tablax2,$select_name,$ids_selected){
		$this->db = SPDO::singleton();			
		$data = $this->db->prepare("SELECT id, ".$select_name." from $tablax2 order by ".$select_name." ASC");	
		echo "SELECT id, ".$select_name." from $tablax2 order by ".$select_name." ASC";
		$data->execute();
		$arg = $data->fetchAll();
	$output = "<select class='form-control' name=\"".$this->fieldname."[]\" id=\"".$this->fieldname."\" MULTIPLE='multiple' size='6' width='100' ".">";

	//$this->toError("SELECT id, ".$select_name." from $tablax2 order by ".$select_name." ASC");
	$ids_selected = explode(",",$ids_selected);
	/* ///$this->toError(implod($ids_selected)); */
	foreach ($arg as $row){
		
		$output .= "<option value=\"".$row['id']."\"";
		if (in_array($row['id'] ,$ids_selected)) $output .= " selected";
		$output .=">".$row[$select_name]."</option>";
	}
	
	$output .= "</select>";
	$output .= "<br>You can select various values at once";
	//$this->toError("BAKE_MULTICOMBO intenta abrir la tabla ".$tablax2);
	return $output;
	}

	function giveme($tabla,$campo,$valor_en_indice){

        $consulta = $this->db->prepare("SELECT * from ".$tabla." where id='$valor_en_indice' limit 1" );
     
        $consulta->execute();
      	$row = $consulta->fetch(PDO::FETCH_NUM);


		if (is_string($row[1]) and  $row[1] != '0' and intval($row[1]) != $row[1] ) return $row[1];
		else if (is_string($row[2]) and $row[2] != '0' ) return $row[2];
		else return  $row[3];
		


	}
	
}

