<?php
class Orm extends ModelBase
{
	var $datatracker;

	public function __construct()
	{
		parent::__construct();
		$this->datatracker = datatrackerModel::singleton();
	}


	public function getTableAttribute($table, $attribute)
	{
		if (!is_file(CORE_PATH . "setup/" . $table . ".php")) {

			#include_once $this->config->get("modelsFolder")."installModel.php";
			$install = new installModel();
			$install->makeSetups($table);
		}
		require  CORE_PATH . "setup/" . $table . ".php";
		return $$attribute;
	}

	public function getItemsHead($table)
	{
		if (!is_file(CORE_PATH . "setup/" . $table . ".php")) {
			$install = new installModel();
			$install->makeSetups($table);
		}
		include_once CORE_PATH . "setup/" . $table . ".php";
		$fr = $fields_labels;
		if (isset($fields_to_show) and is_array($fields_to_show) and count($fields_to_show) > 0) {
			$fr = array();
			for ($i = 0; $i < count($fields); $i++):
				if (in_array($fields[$i], $fields_to_show))
					$fr[] = $fields_labels[$i];
			endfor;
		}

		return $fr;
	}
	public function getAllByField($table, $field, $rid_in_field)
	{




		$order = (get_param('sorder') != -1) ? get_param('sorder') : $default_order;

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

		include CORE_PATH . "setup/" . $params['table'] . ".php";

		$order = (get_param('sorder') != -1) ? get_param('sorder') : $default_order;
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

	private function rowExtras($array, $table)
	{
		return $array;
		foreach ($array as &$r) {
			$consulta = $this->db->prepare('SELECT * FROM comments where object = :object and objectid = :objectid order by commentsId DESC limit 1');
			$consulta->bindParam(":object", $table);
			$consulta->bindParam(":objectid", $r[$table . "Id"]);
			$consulta->execute();
			if ($q = $consulta->fetch()) {


				$r['last_comment'] = substr(strip_tags($q['body']), 0, 245) . "...";
			} else {
				$r['last_comment'] = "";
			}
		}
		return $array;
	}

	public function getAll($table)
	{




		$order = (get_param('sorder') != -1) ? get_param('sorder') : $default_order;
		$table_aux = $table;
		$table_no_prefix = $table;
		$params = gett();


		if (isset($group_by) and !empty($group_by)) $order .= ' GROUP BY ' . $group_by . ' ';
		$consulta = $this->db->prepare('SELECT * FROM ' . $table_aux . ' order by ' . $table . '.' . $order);
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
		$array_return = $this->rowExtras($array_return, $table);
		return $array_return;
	}

	public function getById($table, $id)
	{




		$order = (get_param('sorder') != -1) ? get_param('sorder') : $default_order;
		$table_aux = $table;

		$table_no_prefix = $table; //substr($table,strlen($this->config->get('db_prefix')));

		$consulta = $this->db->prepare('SELECT * FROM ' . $table_aux . ' where ' . $table_no_prefix . 'Id ="' . $id . '" order by ' . $order);
		$consulta->execute();

		return $consulta->fetch();
	}
	public function table_js($table)
	{
		require CORE_PATH . "setup/" . $table . ".php";
		$output = "";
		$output .= "$(document).ready(function(){";
		//$output .="$('#tablaMain').pagination();";


		$output .= "         $('.tablaMain').bdt({ pageRowCount:200, search: false});";

		if (isset($table_order_on) and $table_order_on) {
			$output .= '$(".tablaMain tbody > tr").mouseover(function(){
				$(this).css("cursor","hand");
				$(this).css("cursor","pointer");	
				});';


			// MAKE TABLE SORTABLE
			$output .= '$(function() {
				firefox = (/firefox/i.test(navigator.userAgent.toLowerCase()));

				$(".tablaMain tbody").sortable({ opacity: 0.6, cursor: "move", helper: firefox === true ? "clone" : void 0, update: function() {
					var aux = $(this).parent().attr("data-table");
					aux_id = -1;
					aux_field = -1;
					if ($(this).parent().attr("data-filter-id")){
						aux_id = $(this).parent().attr("data-filter-id");
						aux_field =$(this).parent().attr("data-filter");
					}
					var order = $(this).sortable("serialize") + "&action=updateRecordsListings&tabla="+aux+"&field="+aux_field+"&id="+aux_id;
					console.log(order);
					$.post("admin/updateOrder", order, function(theResponse){
						console.log(theResponse);
					});
				}

				});
				
				});';
		}





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

	public function add($table)
	{

		include_once CORE_PATH . "setup/" . $table . ".php";

		$add_info_form = "";
		$tmp_path = APP_UPLOAD_PATH;

		// UPLOADS FOLDER
		if ($table == "attachments") {
			if (!is_dir(APP_UPLOAD_PATH . get_param('object') . "/" . get_param('objectid'))) {
				mkdir(APP_UPLOAD_PATH . get_param('object') . "/" . get_param('objectid'));
				chmod(APP_UPLOAD_PATH . get_param('object') . "/" . get_param('objectid'), '1777');
				chown(APP_UPLOAD_PATH . get_param('object') . "/" . get_param('objectid'), 'gophpj');
			}

			$newpath = APP_UPLOAD_PATH . get_param('object') . "/" . get_param('objectid') . "/";
			//TO-DO: uploads will not work
			$tmp_path =  $newpath;
		}

		for ($i = 0; $i < count($fields); $i++) {

			if ($fields[$i] != $table . 'Id') {
				$retrieved = '';
				if ($fields_types[$i] != 'file_img' and $fields_types[$i] != 'file_file') {
					$retrieved = get_param($fields[$i]);
				} else $retrieved = -1;

				if (!class_exists($fields_types[$i])) die("La clase " . $fields_types[$i] . " no existe");
				$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $retrieved, $table);
				$add_info_form .= "'" . $field_aux->exec_add() . "',";
			}
		}

		$info = substr($add_info_form, 0, strlen($add_info_form) - 1);
		$consulta = $this->db->prepare("INSERT INTO " . $table . " (" . implode(",", $fields) . ") VALUES ($info)");
		$consulta->execute();

		$id =  $this->getLastInsertedId($table);

		if ($table == "comments") {
			$rid = get_param('objectid');
			$table = get_param('object');
			$d = $this->db->prepare("UPDATE " . $table . " set updated = NOW() where " . $table . "Id = '" . $rid . "'");
			$d->execute();
		}

		# Send notification new ticket created by a superadmin
		if ($table == "tickets") {
			$ticket = gett();
			$ticket['ticketsId'] = $id;
			$users = new usersModel();
			$mails = new mailsModel();
			$webs = new websModel();
			$web = $webs->getByWebsId($ticket['websId']);

			if ($_SESSION['user']['usersId'] != $ticket['developersId']) {
				$subject = '[INFO] Nuevo ticket asignado';
				$user = $users->getByUsersId($ticket['developersId']);
				$ticket['url'] = $web['url'];
				$mails->sendTemplate('ticket_asigned', $ticket, $user['email'], $subject);
			}

			$customers = new customersModel();
			$customer = $customers->getByCustomersId($ticket['customersId']);
			$user = $users->getByUsersId($customer['usersId']);
			$ticket['url'] = $web['url'];

			$subject = "[INFO] Nuevo ticket añadido " . $web['url'];
			$mails->sendTemplate('ticket_new', $ticket, $user['email'], $subject);
		}

		$this->datatracker->push($table . "-add");

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

	public function edit($table, $rid)
	{

		include_once CORE_PATH . "setup/" . $table . ".php";

		$edit_info_form = "";
		$current = $this->getFormValues($table, $rid);
		$new = array();

		for ($i = 0; $i < count($fields); $i++) {
			if (isset($_POST[$fields[$i]]) or isset($_GET[$fields[$i]])) {
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
		$table_no_prefix =  $table;
		$consulta = $this->db->prepare("UPDATE " . $table . " set  $info   where " . $table_no_prefix . "Id='" . $rid . "'");
		$consulta->execute();


		# PATCH TO UPDATE TICKETS  -  DEPRECATED. only superadmin
		if ($table == "tickets" and $current['ticketsstatusId'] != 4 and $new['ticketsstatusId'] == 4) {
			// completado
			$consulta = $this->db->prepare("UPDATE tickets set  date_end = NOW(),progress=100,done=1   where ticketsId='" . $rid . "'");
			$consulta->execute();
		}


		$this->datatracker->push($table . "-edit");
	}

	// DEPRECATED ??
	public function updateInforme($var)
	{


		$final = $testing = $field = $v = $label = null;
		$id = $_POST['objectid'];
		if (empty($id)) die("No hay id");
		if ($_POST['informe_final']) {
			$field = "informe_final";
			$v = $_POST['informe_final'];
			$label = "INFORME FINAL:<br>==============================<br>";
		} else if ($_POST['informe_testing']) {
			$field = "informe_testing";
			$v = $_POST['informe_testing'];
			$label = "TESTING:<br>==============================<br>";
		}

		$c = $this->db->prepare("UPDATE tickets SET " . $field . " = '" . $v . "' where ticketsId = '" . $id . "'");

		$c->execute();

		$d = $this->db->prepare("UPDATE tickets set updated = NOW() where ticketsId = '" . $id . "'");
		$d->execute();


		$comments = new commentsModel();
		$comments->push('tickets', $id, $label . $v, $_SESSION['user']['usersId']);

		header("location: " . $_POST['return_url']);
	}




	public function form_js($table)
	{
		require CORE_PATH . "setup/" . $table . ".php";
		$output = "";

		if ($table == "customers" or $table == "tickets" or in_array('fecha', $fields_types) or in_array('hora', $fields_types) or in_array('combo_child', $fields_types) or in_array('tinymce', $fields_types))


			// 	$output.= 'tinymce.init({
			//    		document_base_url: "'.$config->get('base_url').'",
			//         mode : "textareas", 

			//       toolbar: "| bold italic underline strikethrough | bullist checklist lists  link ",
			// autosave:true,
			//     menubar: false,
			//         selector : ".mceEditor",
			//         width: "100%",
			//         height: "350px",
			//    branding: false,
			//   plugins: " paste   tinydrive  autolink  image embed image img   fullscreen  link  template  table charmap hr  nonbreaking anchor toc insertdatetime  lists      source code ",
			//    tinydrive_token_provider: "dropbox",
			//   tinydrive_dropbox_app_key: "ymbe6eootc2fbi7",



			//   toolbar: " bold italic underline strikethrough link |  bullist checklist | removeformat fullscreen code source   ", 
			//   autosave_ask_before_unload: true,
			//     image_advtab: false,
			//    importcss_append: false,

			//   image_caption: false,




			//         
			//     });'; 

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
				if ($fields_types[$i] == "customers") {
					$output .= '$("#customersId").select2();';
				}
				if ($fields_types[$i] == 'webs') {
					$output .= '$("#websId").filterOn("#customersId") ;';
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

	function updatePresupuesto()
	{


		$rid = $_GET['presupuestosId'];

		$v = ($_GET['v']);
		$v = explode(",", $v);
		$v = array_unique($v);
		$v = implode(",", $v);

		$consulta = $this->db->prepare("UPDATE presupuestos SET content = :v WHERE presupuestosId= :rid");
		$consulta->bindParam(":v", $v);
		$consulta->bindParam(":rid", $rid);
		$consulta->execute();
		echo $v;
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
						@unlink($ninjaconfig->base_dir_img . $row2[$fields[$i]]);
						@unlink($ninjaconfig->base_dir_img . "thumbs/" . $row2[$fields[$i]]);
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
}
