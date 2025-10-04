<?php

final class combo extends field
{

	function view()
	{

		$f_fieldname = str_replace("Id", "", $this->fieldname);
		return $this->giveme($f_fieldname, $this->fieldname, $this->value);
	}
	function bake_field()
	{
		$output = '';
		//$output = "<div id=\"combo_".$this->fieldname."\">";
		#if ($this->config->get('combo_add') == 1) $output .= "<a href=\"javascript:show_add_option_box('".$this->fieldname."');\"> <img  src=\"".$this->config->get('base_http')."lib/img/plus.jpg\"></a>&nbsp;&nbsp;";
		// Field name foreign
		$f_fieldname = str_replace("Id", "", $this->fieldname);
		$output .= $this->bake_combo($f_fieldname, $this->fieldname, $this->value);
		//$output .= "</div>";
		// Parte invisible que aparece para anadir una nueva opcion al select
		#if ($this->config->get('combo_add') == 1 ) $output .= "<div id=\"div_".$this->fieldname."\" style=\"display:none;\">
		#				<input class=\"text-input medium-input \" type=\"text\" cols=\"120\" id=\"new_".$this->fieldname."\"> <input class='btn btn-success' type=\"button\" value=\"A&ntilde;adir\" onclick=\"add_new_option_to_combo('".$this->fieldname."');\"> &nbsp;&nbsp; <a href=\"javascript:close_add_option_box('".$this->fieldname."');\"><img src=\"".$this->config->get('base_http')."lib/img/close.jpg\"></a>
		#				</div>";
		return $output;
	}

	function exec_add()
	{
		return $this->value;
	}
	function exec_edit()
	{
		return $this->value;
	}

	function giveme($tabla, $campo, $valor_en_indice)
	{

		if ($valor_en_indice !== ""):
			$consulta = $this->db->prepare("SELECT * from " . $tabla . " where " . $tabla . "Id='$valor_en_indice' limit 1");
			$consulta->execute();
			$row = $consulta->fetch(PDO::FETCH_NUM);
			if ($row):
				switch ($tabla):
					case 'webs':
						return $row[1];
						break;
					case 'users':

						return $row[2];
						break;

					case 'customers':

						return $row[2];
						break;

					default:
						return $row[1];

				endswitch;
			endif;
		endif;
		return "-";
	}


	function bake_combo($tabla, $select_name, $id_selected)
	{

		$consulta = $this->db->prepare("SELECT * from $tabla ORDER BY 1 ASC");

		if ($tabla == "webs") {
			$consulta = $this->db->prepare("SELECT * from $tabla ORDER BY url ASC");
		}
		if ($tabla == "customers") {
			$consulta = $this->db->prepare("SELECT * from $tabla ORDER BY name ASC");
		}
		$consulta->execute();

		$output = "<select class='form-control block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6' name=\"" . $select_name . "\" id=\"" . $select_name . "\" >";
		$output .= "<option value=\"-1\">---</option>";

		$i = 0;

		if ($tabla == "users" and ($id_selected == -1 or $id_selected === "")) {
			$id_selected = $_SESSION['user']['usersId'];
		}

		while ($row = $consulta->fetch(PDO::FETCH_NUM)) {
			$output .= "<option value=\"" . $row[0] . "\"";
			if ($row[0] == $id_selected) $output .= " selected";
			$output .= " $id_selected>";

			if (is_string($row[1]) and $row[1] != '' and $row[1] != '0' and intval($row[1]) == 0 and substr($row[1], -3) != 'jpg' and substr($row[1], -3) != 'png' or !isset($row[2])) $output .= $row[1] . "</option>";

			else if (is_string($row[2]) and $row[2] != '' and $row[2] != '0' and intval($row[2]) == 0 and substr($row[2], -3) != 'jpg') $output .= $row[2] . "</option>";
			else if (is_string($row[3]) and $row[3] != '' and $row[3] != '0' and intval($row[3]) == 0 and substr($row[3], -3) != 'jpg') $output .= $row[3] . "</option>";
			else $output .= $row[4] . "</option>";
			$i++;
		}
		//$output .='<option value="">Sin especificar</option>';
		$output .= "</select>";

		return $output;
	}
}
