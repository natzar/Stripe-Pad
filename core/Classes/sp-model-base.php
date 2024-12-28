<?php

/**
 * ModelBase
 */
abstract class ModelBase
{
	public $db;
	public $model;
	public $table;

	public function __construct()
	{
		$this->db = SPDO::singleton();
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}
	/**
	 * getLastId
	 *
	 * @return int id
	 */
	public function getLastId()
	{
		$stmt  = $this->db->query("SELECT LAST_INSERT_ID()");
		$c  = $stmt->fetch(PDO::FETCH_ASSOC);
		$cid = $c['LAST_INSERT_ID()'];
		return $cid;
	}
	public function setField($table, $id, $field, $value)
	{
		$q = $this->db->prepare("UPDATE :t set :f = :v where :fid = :id");
		$q->bindParam(":t", $table);
		$q->bindParam(":f", $field);
		$q->bindParam(":v", $value);
		$q->bindParam(":fid", $table . "Id");
		$q->bindParam(":id", $id);
		if ($q->execute()) {
			return true;
		}
		return false;
	}


	/**
	 * getOrmDescription
	 * I think you have to explain a couple things and answer some questions ....
	 * @param  mixed $table
	 * @return void
	 */
	public function getOrmDescription($table)
	{
		if (!isset($table) or $table == '')
			die("no table selected");

		$description = array(
			"table_label" => $table,
			"fields" => array(),
			"fields_types" => array(),
			"fields_labels" => array()
		);

		$recordset = $this->db->prepare("DESCRIBE $table");
		$recordset->execute();

		$cols = $recordset->fetchAll(PDO::FETCH_ASSOC);

		foreach ($cols as $field) {

			$name = $field['Field'];
			$feature = explode("(", $field['Type']);
			$type  = strtolower($feature[0]);

			if ($name != $table . "Id" and $name != "created") $description['fields'][] = $name;

			if ($type == 'int') $type = 'number';
			if ($type == 'double') $type = 'number';
			if ($type == 'time') $type = 'hora';
			if ($type == 'string' or $type == 'varchar') $type = 'literal';
			if ($type == 'blob' or $type == "mediumtext") $type = 'text';
			if (strstr($name, "Id")) $type = 'combo';
			if ($type == 'date') $type = 'fecha';
			if ($type == 'tinyint') $type = 'truefalse';
			if ($type == 'datetime') $type = 'fecha';
			if ($name == 'password') $type = 'password';

			if (strstr($name, "_file")) $type = 'file_file';
			if (strstr($name, "image")) $type = 'file_img';
			if (strstr($name, "content") or $type == 'text') $type = "text"; // remove WYSIWYG editor (tinymce)

			if ($name != $table . "Id" and $name != "created") $description['fields_types'][] =  $type;
		}


		// Default labels
		$description['fields_labels'] = $description['fields'];
		$description['fields_to_show'] = $description['fields'];
		$description['default_order'] = $table . "Id DESC";
		return $description;

		// DEPRECATED
		// 		$aux = fopen(APP_UPLOAD_PATH . $tabla . '.php', 'w');
		// 		$resultx =  '<?        
		// $table_label = "' . $table . '";
		// $default_order = "' . $table . 'Id ASC";
		// $fields= array(' . $campos_a_mostrar . ');        
		// $fields_labels= array(' . $labels . ');        
		// $fields_types=array(' . $types . ');
		// ';

		// 		fwrite($aux, $resultx);	fclose($aux);


	}
}
