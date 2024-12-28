<?php


/**
 * Package Name: Stripe Pad
 * File Description: Experimental Class to generate code and fake db data
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This file is part of Stripe Pad.
 *
 *	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 *	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */


class StripePadGenerator extends ModelBase
{
	public function fillDb($num_recs)
	{
		$prefix = '';
		$dbname = APP_DB;

		$consulta = $this->db->prepare('SHOW TABLES FROM ' . $dbname);
		$consulta->execute();
		$_SESSION['errors'] .= '<strong>Filling DB with fake data...</strong><hr>';
		$STRINGS = array("Lorem ipsum dolor sit amet", "dolore eu fugiat", "mollit anim id est laborum.");

		while ($row = $consulta->fetch(PDO::FETCH_NUM)) {
			$tabla = $row[0];
			$_SESSION['errors'] .= $tabla . ': ' . $num_recs . ' new records<br>';
			if ($prefix == '' or strstr($tabla, $prefix)) {
				include $config->get('setupFolder') . $tabla . ".php";
				$num_entry = 0;
				while ($num_entry < $num_recs) {
					$types = '';
					for ($i = 0; $i < count($fields); $i++) {
						$field = $fields[$i];
						$type  = $fields_types[$i];
						if ($type == 'file_img') $type = rand(1, 3) . ".jpeg";
						if ($type == 'number' or $type == 'float') $type = '59.60';
						if ($type == 'literal') $type = $STRINGS[rand(0, count($STRINGS) - 1)];
						if ($type == 'text') $type = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
						if (strstr($field, "Id")) $type = '1';
						if ($type == 'fecha') $type = '2013-1-2';
						if ($type == 'truefalse') $type = rand(0, 1);

						$types .=  '"' . $type . '",';
					}

					$types = substr($types, 0, strlen($types) - 1);
					$updater = $this->db->prepare('INSERT INTO ' . $tabla . ' (' . implode(",", $fields) . ') VALUES (' . $types . ')');
					$updater->execute();
					//	$_SESSION['errors'] = 'INSERT INTO '.$tabla.' ('.implode(",",$fields).') VALUES ('.$types.')';
					$num_entry++;
				}
			}
		}
	}

	public function generateModels($params)
	{

		$prefix = '';
		$dbname = APP_DB;
		$consulta = $this->db->prepare('SHOW TABLES FROM ' . $dbname);
		$consulta->execute();
		$path = dirname(__FILE__);

		//		$aux = fopen($path.'/../application/controllers/'.$tabla.'Controller.php','w');
		if (!is_writable($path . '/../controllers/')) {
			$_SESSION['errors'] .= "<strong>Don't have permission to write in /application/controllers and /application/models </strong><br>
		Give em 777 permission.";
			return false;
		}



		while ($row = $consulta->fetch(PDO::FETCH_NUM)) {
			$tabla = $row[0];
			$tabla_no_prefix = substr($tabla, strlen($config->get('db_prefix')));
			$_SESSION['errors'] .= '<hr><p>  <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Creating Models and Controllers ' . $tabla . '</p>';


			if ($prefix == '' or strstr($tabla, $prefix) or $tabla == $prefix) {
				$recordset = $this->db->prepare("DESCRIBE $tabla");
				$recordset->execute();
				$campos_a_mostrar = $types = '';
				$xxx = $recordset->fetchAll(PDO::FETCH_ASSOC);
				foreach ($xxx as $field) {
					//$_SESSION['errors'].= "<br>";
					$name = $field['Field'];
					if ($name != $tabla . "Id") $campos_a_mostrar .=  $name . ',';
				}
				$campos_a_mostrar = substr($campos_a_mostrar, 0, strlen($campos_a_mostrar) - 1);
				$types = substr($types, 0, strlen($types) - 1);


				$resultx =  '<?
// ' . strtoupper(APP_NAME) . '
// ' . $tabla_no_prefix . ' Controller
// ' . date("m-Y") . '
// Beto Ayesa @ 96levels 
// www.96levels.com / hello@96levels.com


class ' . $tabla_no_prefix . 'Controller extends ControllerBase
{
		public function index(){
			require "application/models/' . $tabla_no_prefix . 'Model.php"; 	
			$' . $tabla_no_prefix . ' = new ' . $tabla_no_prefix . 'Model();			
			$data = Array(
				  "items" => $' . $tabla_no_prefix . '->getAll()
		          );         
			$this->view->show("templates/table.php", $data);
		}
		
		public function detail(){
			require "application/models/' . $tabla_no_prefix . 'Model.php"; 	
			$' . $tabla_no_prefix . ' = new ' . $tabla_no_prefix . 'Model();	
			$params = gett();
			$id = $params["a"];		
			$data = Array(
				  "items" => $' . $tabla_no_prefix . '->getBy' . $tabla_no_prefix . 'Id($id)
		          );         
			$this->view->show("templates/detail.php", $data);
		}
		
';

				if ($tabla == 'users'):
					$resultx .= '

		public function signup(){
			$this->view->show("signup.php", array());
		
		}
';

				endif;
				$aux = explode(",", $campos_a_mostrar);
				foreach ($aux as $p):
					if (strstr($p, 'Id')) {
						$strip = str_replace("Id", "", $p);
						if ($strip == $tabla_no_prefix) $strip = 'detail';
						$resultx .= '

		public function ' . $strip . '(){
			$params = gett();
			require "application/models/' . $tabla_no_prefix . 'Model.php"; 	
			$' . $tabla_no_prefix . ' = new ' . $tabla_no_prefix . 'Model();
			$data = Array(
				  "items" => $' . $tabla_no_prefix . '->getBy' . ucfirst($p) . '($' . 'params["a"])
			      );	          
			$this->view->show("related-table.php", $data);
		}		
';
					}
				endforeach;
				$resultx .= '
		
		public function add(){
			require "application/models/' . $tabla_no_prefix . 'Model.php";          
			$' . $tabla_no_prefix . ' = new ' . $tabla_no_prefix . 'Model();
			$params = gett();
			$params[\'table\'] = "' . $tabla_no_prefix . '";
			if ($' . $tabla_no_prefix . '->POST($params)) echo 1;
			else echo 0;

		}
		
		public function edit(){
			require "application/models/' . $tabla_no_prefix . 'Model.php";          
			$' . $tabla . ' = new ' . $tabla . 'Model();
			$params = gett();
			$params = gett();
			$params[\'table\'] = "' . $tabla . '";
			if ($' . $tabla . '->PUT($params)) echo 1;
			else echo 0;
		}
		
		public function delete(){
			require "application/models/' . $tabla . 'Model.php";          
			$' . $tabla . ' = new ' . $tabla . 'Model();
			$params = gett();
			if ($' . $tabla . '->delete($params)) echo 1;
			else echo 0;
		}
		
		public function search(){
			$params = gett();
			require "application/models/' . $tabla . 'Model.php"; 	
			$' . $tabla . ' = new ' . $tabla . 'Model();
	
			$json = new Services_JSON();	
			$data = Array( "items" =>  $' . $tabla . '->search($params)	);         
			$this->view->show("search.php", $data);
		}


}';

				$aux = explode(",", $campos_a_mostrar);

				$cadena_insert = $cadena_update = $form = "";
				foreach ($aux as $i) {
					if ($i != -1)
						$cadena_insert .= "'\".$" . "params['$i'].\"',";
				}
				foreach ($aux as $i) {
					if ($i != -1)
						$cadena_update .= $i . " = '\".$" . "params['$i'].\"',";
				}

				/* FORM ADD */
				$form_html = "<form class='form' name='" . $tabla . "-add' action='" . $tabla . "/add' method='POST' enctype='multipart/form-data'>";


				foreach ($aux as $i) {
					if ($i != -1)


						$form_html .= "


<label>";
					$form_html .= $i;
					$form_html .= "</label>

";
					$form_html .= "<input type='text' name='" . $i . "' value=''>";
				}
				$form_html .= '<input type="button" onclick="validate(this.form);" value="Enviar"></form>';



				/* FORM EDIT */

				$form_html2 = "<form class='form' action='" . $tabla . "/edit' method='POST' enctype='multipart/form-data'>";

				foreach ($aux as $i) {
					if ($i != -1)


						$form_html2 .= "


<div class='control-group'><label class='control-label'>";
					$form_html2 .= $i;
					$form_html2 .= "</label>

<div class='controls'>";
					$form_html2 .= "<input type='text' name='" . $i . "' value='<?= $" . "items['" . $i . "'] ?>'></div></div>";
				}
				$form_html2 .= '<input type="hidden" name="id" value="<?= $' . 'items["id"]; ?>"><input type="button" onclick="validate(this.form);" value="Enviar"></form>';


				/* MODELS */

				$cadena_update = substr($cadena_update, 0, -1);
				$cadena_insert = substr($cadena_insert, 0, -1);


				$joins = array();
				foreach ($aux as $p):
					if (strstr($p, 'Id') and !strstr($p, '_')) {
						$joins[] = "LEFT JOIN " . str_replace("Id", "", $p) . " ON (" . $tabla . "." . $p . " = " . str_replace("Id", "", $p) . "." . $p . ")";
					}

				endforeach;

				$result_Models = '<?

// ' . APP_NAME . ' 
// ' . $tabla . ' Model
// ' . date("m-Y") . '
// Beto Ayesa beto@ayesadigital.com

class ' . $tabla . 'Model extends ModelBase
{

		public function getAll(){


				$consulta = $this->db->prepare("SELECT * FROM ' . $tabla . ' ' . implode(" ", $joins) . '");
				$consulta->execute();
				$aux2 = $consulta->fetchAll();

				return $aux2;
		}
		
		public function getFieldValueById($field,$id){


				$consulta = $this->db->prepare("SELECT $field FROM ' . $tabla . ' ' . implode(" ", $joins) . ' where ' . $tabla . '.' . $tabla . 'Id =\'".$id."\' limit 1");
				$consulta->execute();
				$c = $consulta->fetch();
				$aux2 = $c[$field];

				return $aux2;
		}
		
		public function getByField($field,$val){


				$consulta = $this->db->prepare("SELECT * FROM ' . $tabla . ' ' . implode(" ", $joins) . ' where ' . $tabla . '.".$field." =\'".$val."\' ");
				$consulta->execute();
				$aux2 = $consulta->fetchAll();
				$this->cache->set("' . $tabla . '_".$field."_".$val,$aux2,600);
				return $aux2;
		}
	


		public function getBy' . ucFirst($tabla) . 'Id($' . 'id){


				$consulta = $this->db->prepare("SELECT * FROM ' . $tabla . ' ' . implode(" ", $joins) . ' WHERE ' . $tabla . '.' . $tabla . 'Id=\'$' . 'id\' limit 1");
				$consulta->execute();
				$aux2 =  $consulta->fetch();

				return $aux2;

		}
';

				foreach ($aux as $p):
					if (strstr($p, 'Id')) {

						$result_Models .= '

		public function getBy' . ucFirst($p) . '($' . 'id){


				$consulta = $this->db->prepare("SELECT * FROM ' . $tabla . ' ' . implode(" ", $joins) . ' WHERE ' . $tabla . '.' . $p . '=\'$' . 'id\' ");
				$consulta->execute();
				$aux2 =  $consulta->fetchAll();

				return $aux2;
		}

';
					}
				endforeach;
				$result_Models .= '
		
		
		public function search($params){
			$aux = $this->cache->get("' . $tabla . '_search_".$params[\'query\']);
			if ($aux == null){
				$consulta = $this->db->prepare("SELECT * FROM ' . $tabla . ' ' . implode(" ", $joins) . ' where title like \'%".$params[\'query\']."%\' ");
				$consulta->execute();
				$aux2= $consulta->fetchAll();
				$this->cache->set("' . $tabla . '_search_".$params[\'query\'],$aux2,600);
				return $aux2;
			}
			return $aux;
		}
		
		
		public function add($params){
			$consulta = $this->db->prepare("INSERT INTO ' . $tabla . ' (' . $campos_a_mostrar . ') VALUES (' . $cadena_insert . ')");
			$consulta->execute();
			if ($consulta->rowCount() > 0) return true;
			else return false;
		}

		public function edit($params){
			$consulta = $this->db->prepare("UPDATE ' . $tabla . ' SET ' . $cadena_update . '  where ' . $tabla . 'Id=' . '\'' . '".$params[' . '\'' . 'id' . '\']' . '."\'");
			$consulta->execute();
			if ($consulta->rowCount() > 0) return true;
			else return false;
		}

		public function delete($params){
			$consulta = $this->db->prepare("DELETE FROM ' . $tabla . ' where ' . $tabla . 'Id=' . '\'' . '".$params[' . '\'' . $tabla . 'Id' . '\']' . '."\'");
			$consulta->execute();
			if ($consulta->rowCount() > 0) return true;
			else return false;
		}
}
';



				$path = dirname(__FILE__);
				@mkdir($path . '/../views/forms/');
				$aux = fopen($path . '/../controllers/' . $tabla_no_prefix . 'Controller.php', 'w');
				fwrite($aux, $resultx);
				fclose($aux);
				$aux = fopen($path . '/../models/' . $tabla_no_prefix . 'Model.php', 'w');
				fwrite($aux, $result_Models);
				fclose($aux);

				$aux = fopen($path . '/../views/forms/add-' . $tabla_no_prefix . '.php', 'w');
				fwrite($aux, $form_html);
				fclose($aux);

				$aux = fopen($path . '/../views/forms/edit-' . $tabla_no_prefix . '.php', 'w');
				fwrite($aux, $form_html2);
				fclose($aux);
			}
		}
	}
}
