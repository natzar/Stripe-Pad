<?php

/**
 * Package Name: Stripe Pad
 * File Description: Simple CRUD/ORM class
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
class Orm extends ModelBase
{
	var $log;

	public function __construct()
	{
		parent::__construct();
		$this->log = log::singleton();
		include CORE_PATH . "orm/field.php";
	}


	public function getTableAttribute($table, $attribute)
	{
		$data = $this->getOrmDescription($table);
		return $data[$attribute];
	}

	public function getItemsHead($table)
	{
		$data = $this->getOrmDescription($table);
		$fr = $data['fields_labels'];
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		if (isset($fields_to_show) and is_array($fields_to_show) and count($fields_to_show) > 0) {
			$fr = array();
			for ($i = 0; $i < count($fields); $i++):
				if (in_array($fields[$i], $fields_to_show))
					$fr[] = $fields_labels[$i];
			endfor;
		}

		return $fr;
	}
	public function getAllByField($table, $field, $rid_in_field, $custom_order = null)
	{
		$model = $table . 'Model';
		$instance = new $model();
		$data = $instance->getOrmDescription();
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$order = is_null($custom_order) ? $data['default_order'] : $custom_order;



		$consulta = $this->db->prepare('SELECT *, FROM ' . $table . ' where ' . $field . '= "' . $rid_in_field . '" order by ' . $order);
		$consulta->execute();
		$array_return = array();

		while ($r = $consulta->fetch()):
			$row_array = array();
			$row_array['id'] = $r['id'];
			for ($i = 0; $i < count($fields); $i++):
				if (!isset($fields_to_show) or in_array($fields[$i], $fields_to_show) or empty($fields_to_show)):
					if (!class_exists($fields_types[$i]))
						die("La clase " . $fields_types[$i] . " no existe");
					$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $r[$fields[$i]], $table,  $row_array['id']);
					$row_array[] = $field_aux->view();
				endif;
			endfor;
			$row_array['last_access'] = $r['last_access'];
			$array_return[] = $row_array;

		endwhile;
		//  $array_return = $this->rowExtras($array_return,$table);
		return $array_return;
	}


	public function search($params)
	{

		$model = $table . 'Model';
		$instance = new $model();
		$data = $instance->getOrmDescription();
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$order = ($this->params['sorder'] != -1) ? $this->params['sorder'] : $default_order;
		$table = $table_aux = $params['table'];

		//	if (isset($group_by) and !empty($group_by)) $table_aux.= ' GROUP BY '.$group_by.' ';  

		$where = array();
		for ($i = 0; $i < count($fields); $i++):
			if (isset($_POST[$fields[$i]])  and !empty($_POST[$fields[$i]]) and $_POST[$fields[$i]] != -1 or isset($params[$fields[$i]]) and $params[$fields[$i]] != -1) {
				$val = isset($_POST[$fields[$i]]) ? $_POST[$fields[$i]] : $params[$fields[$i]];



				if ($fields_types[$i] == 'literal' or $fields_types[$i] == 'text')
					$where[] = $fields[$i] . ' LIKE "%' . $val . '%"';
				else if (is_array($val))
					$where[] = $fields[$i] . " IN (" . implode(",", $val) . ")";

				else if ($fields_types[$i] == "combo" and $fields[$i] == "plansId")
					$where[] = $fields[$i] . " >= " . $val;
				else
					$where[] = $fields[$i] . ' like "' . $val . '"';
			}
		endfor;
		if (count($where) < 1) return array();

		$consulta = $this->db->prepare('SELECT *,' . $table . '.created as created, (SELECT created from logs where object="' . $table . '" and objectid=' . $table . '.' . $table . 'Id and usersId = ' . $_SESSION['user']['usersId'] . ' order by created DESC limit 1) as last_access FROM ' . $table_aux . ' WHERE ' . implode(' AND ', $where) . ' order by ' . $order);
		$consulta->execute();
		$array_return = array();

		while ($r = $consulta->fetch()):
			$row_array = array();
			$row_array[$table . 'Id'] = $r[$table . 'Id'];
			for ($i = 0; $i < count($fields); $i++):
				if (!isset($fields_to_show) or in_array($fields[$i], $fields_to_show) or empty($fields_to_show)):
					if (!class_exists($fields_types[$i]))
						die("La clase " . $fields_types[$i] . " no existe");
					$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $r[$fields[$i]], $table, $row_array[$table . 'Id']);
					$row_array[$fields[$i]] = $field_aux->view();
				endif;

			endfor;
			//$row_array['last_access'] = $r['last_access'];
			$row_array['created'] = $r['created'];
			$array_return[] = $row_array;

		endwhile;
		// $array_return = $this->rowExtras($array_return,$table);
		return $array_return;
	}



	public function getAll($table, $custom_order = null)
	{

		$data = $this->getOrmDescription($table);
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$order = is_null($custom_order) ? $data['default_order'] : $custom_order;
		$table_aux = $table;
		$table_no_prefix = $table;
		$consulta = $this->db->prepare('SELECT * FROM ' . $table . ' order by ' . $table . '.' . $order);
		$consulta->execute();
		$array_return = array();

		while ($r = $consulta->fetch()):
			$row_array = array();
			$row_array[$table_no_prefix . 'Id'] = $r[$table_no_prefix . 'Id'];
			for ($i = 0; $i < count($fields); $i++):
				if (!isset($fields_to_show) or in_array($fields[$i], $fields_to_show) or empty($fields_to_show)):
					if (!class_exists($fields_types[$i]))
						die("La clase " . $fields_types[$i] . " no existe");
					$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $r[$fields[$i]], $table, $row_array[$table_no_prefix . 'Id']);
					$row_array[$fields[$i]] = $field_aux->view();
				endif;
			endfor;
			$array_return[] = $row_array;

		endwhile;
		return $array_return;
	}

	public function getById($table, $id)
	{
		$consulta = $this->db->prepare('SELECT * FROM ' . $table . ' where ' . $table . 'Id ="' . $id . 'limit 1');
		$consulta->execute();

		return $consulta->fetch();
	}
	public function table_js($table)
	{

		$output = "";
		$output .= "$(document).ready(function(){";
		//$output .="$('#tablaMain').pagination();";


		$output .= "         $('.tablaMain').bdt({ pageRowCount:200, search: false});";






		$output .= "});"; // End $(document).ready();


		// final funciones de check form
		return $output;
	}

	public function getFormValues($table, $rid)
	{
		$table_no_prefix = $table;
		$consulta = $this->db->prepare("SELECT * FROM " . $table . " where " . $table_no_prefix . "Id='" . $rid . "' limit 1");
		$consulta->execute();
		return $consulta->fetch();
	}

	public function add($table, $params)
	{

		$data = $this->getOrmDescription($table);
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$table_aux = $table;
		$table_no_prefix = $table;

		$add_info_form = "";
		$tmp_path = APP_UPLOAD_PATH;

		for ($i = 0; $i < count($fields); $i++) {

			if ($fields[$i] != $table . 'Id') {
				$retrieved = '';
				if (isset($params[$fields[$i]]) and $fields_types[$i] != 'file_img' and $fields_types[$i] != 'file_file') {
					$retrieved = $params[$fields[$i]];
				} else $retrieved = -1;

				if (!class_exists($fields_types[$i])) die("La clase " . $fields_types[$i] . " no existe");
				$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $retrieved, $table);
				$add_info_form .= "'" . $field_aux->exec_add() . "',";
			}
		}

		$info = substr($add_info_form, 0, strlen($add_info_form) - 1);
		$consulta = $this->db->prepare("INSERT INTO " . $table . " (" . implode(",", $fields) . ") VALUES ($info)");
		$consulta->execute();
		$id =  $this->getLastId($table);
		$this->log->push($table . "-add");

		return $id;
	}

	public function updateField()
	{

		$table = get_param('table');
		$rid = get_param('rid');




		$edit_info_form = "";
		$current = $this->getFormValues($table, $rid);
		$new = array();
		for ($i = 0; $i < count($fields); $i++) {
			if (isset($_POST[$fields[$i]])) {
				if ($fields[$i] != $table . 'Id') {
					$retrieved = '';
					if (!strstr($fields_types[$i], 'file_') and  get_param($fields[$i]) != -1) {
						$retrieved = get_param($fields[$i]);
					}

					if ($retrieved == -1) $retrieved = '';

					if (!class_exists($fields_types[$i])) die("La clase " . $fields_types[$i] . " no existe");
					if (strstr($fields_types[$i], 'file_') and $_FILES[$fields[$i]]['name'] != "" or !strstr($fields_types[$i], 'file_')) {

						if ($retrieved == "" and $fields_types[$i] == "password") {
						} else {
							$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $retrieved, $table, $rid);
							$edit_info_form .= " " . $table . "." . $fields[$i] . " = '" . $field_aux->exec_edit() . "',";
							$new[$fields[$i]] = $field_aux->exec_edit();
						}
					}
				}
			}
		}

		$info = substr($edit_info_form, 0, strlen($edit_info_form) - 1);
		$table_no_prefix = $table;
		$sql = "UPDATE " . $table . " set  " . $info . "   where " . $table_no_prefix . "Id=:id";

		$consulta = $this->db->prepare($sql);
		$consulta->bindParam(":id", $rid);
		$consulta->execute();
	}

	public function edit($table, $rid, $params)
	{

		$data = $this->getOrmDescription($table);
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$table_aux = $table;
		$table_no_prefix = $table;

		$edit_info_form = "";
		$current = $this->getFormValues($table, $rid);
		$new = array();

		for ($i = 0; $i < count($fields); $i++) {
			if (isset($_POST[$fields[$i]]) or isset($_GET[$fields[$i]])) {
				if ($fields[$i] != $table . 'Id') {
					$retrieved = '';
					if (isset($params[$fields[$i]]) and !strstr($fields_types[$i], 'file_') and  $params[$fields[$i]] != -1) {
						$retrieved = $params[$fields[$i]];
					}

					if ($retrieved == -1) $retrieved = '';

					if (!class_exists($fields_types[$i])) die("La clase " . $fields_types[$i] . " no existe");
					if (strstr($fields_types[$i], 'file_') and $_FILES[$fields[$i]]['name'] != "" or !strstr($fields_types[$i], 'file_')) {

						if ($retrieved == "" and $fields_types[$i] == "password") {
						} else {
							$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $retrieved, $table, $rid);
							$edit_info_form .= " " . $table . "." . $fields[$i] . " = '" . $field_aux->exec_edit() . "',";
							$new[$fields[$i]] = $field_aux->exec_edit();
						}
					}
				}
			}
		}

		$info = substr($edit_info_form, 0, strlen($edit_info_form) - 1);
		$table_no_prefix =  $table;
		$consulta = $this->db->prepare("UPDATE " . $table . " set  $info   where " . $table_no_prefix . "Id='" . $rid . "'");
		$consulta->execute();


		# PATCH TO UPDATE TICKETS  -  DEPRECATED. only superadmin
		if ($table == "tickets" and $current['ticketsstatusId'] != 4 and $new['ticketsstatusId'] == 4) {
			// completado
			$consulta = $this->db->prepare("UPDATE tickets set  date_end = NOW(),progress=100,done=1   where ticketsId='" . $rid . "'");
			$consulta->execute();
		}


		$this->log->push($table . "-edit");
	}

	public function form_js($table)
	{
		$data = $this->getOrmDescription($table);
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$output = "";

		if (in_array('fecha', $fields_types) or in_array('hora', $fields_types) or in_array('combo_child', $fields_types))

			for ($i = 0; $i < count($fields); $i++) {
				/*
						if ($fields_types[$i] == 'fecha')
							$output .='$(function() {	$("#'.$fields[$i].'").datepicker({
							 format: "dd/mm/yyyy H:i:s",
							 todayHighlight: "true",
							 todayHighlight: true,
							 weekStart: 1,
							 autoclose: true

							}); }
							);';
*/

				if ($fields_types[$i] == 'hora') {
					$output .= "$('#" . $fields[$i] . "').timepicker({
									hourGrid: 4,
									minuteGrid: 10,
									timeFormat: 'hh:mm:ss'
									});";
				}
				if ($fields_types[$i] == 'horario') {
					$output .= "$('#" . $fields[$i] . "_hora').timepicker({
									showMeridian: false,
									template: false,
                showInputs: false,
                defaultTime: '00:00'
									});";
				}

				if ($fields_types[$i] == "slug") {
					$lang = substr($fields[$i], -2);
					$output .= '$(document).ready(function(){ $("#title_' . $lang . '").change(function(){ $("#' . $fields[$i] . '").val($("#title_' . $lang . '").val()); validateSlug("' . $fields[$i] . '");}); });';
				}
			}

		/* Before Submit */
		$output .= "\n function check_form_values(z){
					
					//var z = document.getElementById(x);
					";
		for ($i = 0; $i < count($fields); $i++) {
			$output .= "if (z." . $fields[$i] . "){";
			switch ($fields_types[$i]) {
				case 'time_spent':
					if ($_SESSION['user']['group'] == "developers") {
						$output .= " if (z." . $fields[$i] . ".value == 0 ){ alert('Por favor introduce el tiempo consumido en minutos');
							z." . $fields[$i] . ".style.background='#ffff66';
									z." . $fields[$i] . ".focus();
									 return false; 
									 }";
					}
					break;
				case 'number':
					$output .= " if((!validateNumber(z." . $fields[$i] . ".value)) && (z." . $fields[$i] . ".value != \"\")){
									alert('No es un valor numerico correcto. Introduzca solo digitos. Utilice . (punto) para los decimales.');
									z." . $fields[$i] . ".style.background='#ffff66';
									z." . $fields[$i] . ".focus();
									return false;
								} 
							";
					break;
				case 'email':
					$output .= " if((!validateEmail(z." . $fields[$i] . ".value)) && (z." . $fields[$i] . ".value != \"\")){
									alert('Email no valido.');
									z." . $fields[$i] . ".style.background='#ffff66';
									z." . $fields[$i] . ".focus();
									return false;
								}
							";
					break;


				case 'url':
					$output .= " if((!validateURL(z." . $fields[$i] . ".value)) && (z." . $fields[$i] . ".value != \"\")){
									alert('URL debe empezar por http:// ');
									z." . $fields[$i] . ".style.background='#ffff66';
									z." . $fields[$i] . ".focus();
									return false;
								}
							";
					break;

				case 'editor':
					$output .= " $('input[name=\"" . $fields[$i] . "\"]').attr('value', encodeURIComponent( $('#" . $fields[$i] . "').elrte('val') )) ;";
					break;
			}
			$output .= "}";
		}
		$output .= " busy();";
		$output .= " z.submit();
		  }";

		return $output;
	}

	function updateOrder()
	{
		$tabla = $_POST['tabla'];
		$table_no_prefix = $tabla;
		$action 				= $_POST['action'];
		$updateRecordsArray 	= $_POST['recordsArray'];
		$field = $_POST['field'];
		$id = $_POST['id'];
		if ($action == "updateRecordsListings") {

			$listingCounter = 0;
			foreach ($updateRecordsArray as $recordIDValue) {
				if ($field != -1 and $id != -1) {
					$consulta = $this->db->prepare("UPDATE " . $tabla . " SET orden = " . $listingCounter . " WHERE " . $field . "='" . $id . "' and id = " . $recordIDValue);
					$consulta->execute();
				} else {
					$consulta = $this->db->prepare("UPDATE " . $tabla . " SET orden = " . $listingCounter . " WHERE  " . $table_no_prefix . "Id = " . $recordIDValue);
					$consulta->execute();
				}
				$listingCounter = $listingCounter + 1;
			}
			echo $listingCounter;
		}
		echo 0;
	}
	function updateTrueFalse()
	{


		$tabla = $_GET['table'];
		$f = $_GET['fieldname'];
		$rid = $_GET['rid'];
		$v = $_GET['v'];
		if ($v == 'true') $v = '1';
		else $v = '0';


		$consulta = $this->db->prepare("UPDATE " . $tabla . " SET " . $f . " = '" . $v . "' WHERE " . $tabla . "Id='" . $rid . "'");
		$consulta->execute();

		return true;
	}
	function updateVisible()
	{


		$tabla = $_GET['table'];
		$rid = $_GET['rid'];
		$v = $_GET['v'];
		if ($v == 'true') $v = '1';
		else $v = '0';


		$consulta = $this->db->prepare("UPDATE " . $tabla . " SET visible = '" . $v . "' WHERE " . $tabla . "Id='" . $rid . "'");
		$consulta->execute();

		return true;
	}

	function updateFeatured()
	{

		$tabla = $_GET['table'];
		$rid = $_GET['rid'];
		$v = $_GET['v'];
		if ($v == 'true') $v = '1';
		else $v = '0';


		$consulta = $this->db->prepare("UPDATE " . $tabla . " SET destacado_home = '" . $v . "' WHERE id='" . $rid . "'");
		$consulta->execute();
	}


	public function deleteRow($table, $id)
	{

		$model = $table . 'Model';
		$instance = new $model();
		$data = $instance->getOrmDescription();
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];

		$table_no_prefix =  $table;
		if (in_array('file_img', $fields) or in_array('file', $fields)) {

			$consulta = $this->db->prepare("SELECT * from " . $table . " where " . $table_no_prefix . "Id='" . $id . "' limit 1");
			$consulta->execute();
			$row2 = $consulta->fetch();

			for ($i = 0; $i < count($fields); $i++) {
				if ($fields_types[$i] == 'file') {
					if ($row2[$fields[$i]] != "")
						@unlink(APP_UPLOAD_PATH . $row2[$fields[$i]]);
				}

				if ($fields_types[$i] == 'file_img') {
					if ($row2[$fields[$i]] != "") {
						@unlink(APP_UPLOAD_PATH . $row2[$fields[$i]]);
						@unlink(APP_UPLOAD_PATH . "thumbs/" . $row2[$fields[$i]]);
					}
				}
			}
		}

		$consulta = $this->db->prepare("DELETE FROM " . $table . " where " . $table_no_prefix . "Id = '" . $id . "'");
		$consulta->execute();
		$this->datatracker->push($table . "-delete-row");
		return true;
	}

	public function deleteImage($table, $field, $id)
	{

		$table_no_prefix = $table;
		$consulta = $this->db->prepare("SELECT $field FROM $table where " . $table_no_prefix . "Id='$id' limit 1");
		$consulta->execute();
		$r = $consulta->fetch();
		@unlink(APP_UPLOAD_PATH . "img/" . $r[$field]);

		$consulta = $this->db->prepare("UPDATE $table set $field='' where " . $table_no_prefix . "Id='$id'");
		$consulta->execute();
		return true;
	}


	/**
	 * generateForm
	 * Returns the HTML for a form
	 * @param  mixed $table
	 * @param  mixed $rid
	 * @param  mixed $fields
	 * @param  mixed $fields_labels
	 * @param  mixed $fields_types
	 * @return void
	 */
	public function generateForm($table, $rid, $op)
	{

		$data = $this->getOrmDescription($table);
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];

		if ($rid == '') {
			$rid = -1;
		}
		$form_html = '';
		$raw = ($rid != -1) ? $this->getFormValues($table, $rid) : '';

		for ($i = 0; $i < count($fields); ++$i) {

			$form_html .= "<div class='form-group'><label class='form-label text-xs text-gray-500'>";
			$form_html .= ucfirst($fields_labels[$i]);
			$form_html .= '</label>';
			// Not used: added to provide hints about the field
			if (isset($field_hints) and $field_hints[$i] != '') {
				$form_html .= '<span class="help">e.g. "' . $field_hints[$i] . '"</span>';
			}
			$form_html .= "<div class='controls'>";
			if (!class_exists($fields_types[$i])) {
				exit('La clase ' . $fields_types[$i] . ' no existe');
			}
			$VALUE = isset($raw[$fields[$i]]) ? $raw[$fields[$i]] : '';
			$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $VALUE, $table, $rid);
			$form_html .= $field_aux->bake_field();
			$form_html .= '</div>';
			$form_html .= ' </div>';
		}

		return [
			'form' => $form_html,
			'HOOK_JS' => $this->form_js($table),
			'table' => $table,
			'raw' => $raw,
			'op' => '',
			'rid' => $rid,
			'table_label' => $data['table_label'],
		];
	}
}
