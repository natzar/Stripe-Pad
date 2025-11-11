<?php



abstract class field
{

	abstract protected function view();
	abstract protected function bake_field();
	abstract protected function exec_add();
	abstract protected function exec_edit();

	public $fieldname;
	public $type;
	public $value;

	public $label;
	public $rid;
	public $table;

	protected $db;

	public final function __construct($fieldname, $label, $type, $value, $table = -1, $rid = -1)
	{
		$this->db = SPDO_sqlite::singleton();

		$this->label = $label;
		$this->fieldname = $fieldname;
		$this->type = $type;
		$this->value = $value;
		$this->table = $table;
		$this->rid = $rid;
	}
	public function bake_field_label($fields_labels, $fields_hints, $i)
	{
		$form_html = "";

		if (isset($fields_labels[$i]) and !empty($fields_labels[$i])) {
			$form_html = "<div class='form-group mb-4'><label class='form-label text-sm font-semibold text-gray-600'>";
			$form_html .= ucfirst($fields_labels[$i]);
			$form_html .= '</label>';
		}
		if (isset($fields_hints[$i]) and !empty($fields_hints[$i])) {
			$form_html .= '<span class="block text-xs mb-2 text-gray-500">' . $fields_hints[$i] . '</span>';
		}
		return $form_html;
	}
	public final function bake_field_html($id, $name, $value, $placeholder = "")
	{
		//class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
	}
}

/* Include field types */
require_once dirname(__FILE__) . "/color.php";

require_once dirname(__FILE__) . "/float.php";

require_once dirname(__FILE__) . "/combo.php";

require_once dirname(__FILE__) . "/combo_child.php";
require_once dirname(__FILE__) . "/dias_semana.php";
require_once dirname(__FILE__) . "/disabled.php";
require_once dirname(__FILE__) . "/progress.php";
require_once dirname(__FILE__) . "/horario.php";
require_once dirname(__FILE__) . "/email.php";

require_once dirname(__FILE__) . "/fecha.php";
require_once dirname(__FILE__) . "/fechahora.php";
require_once dirname(__FILE__) . "/file_file.php";
require_once dirname(__FILE__) . "/file_img.php";
require_once dirname(__FILE__) . "/file_img_multi.php";

require_once dirname(__FILE__) . "/enum.php";
require_once dirname(__FILE__) . "/float.php";
require_once dirname(__FILE__) . "/hora.php";
require_once dirname(__FILE__) . "/literal.php";

require_once dirname(__FILE__) . "/multiselect.php";
require_once dirname(__FILE__) . "/number.php";
require_once dirname(__FILE__) . "/password.php";
require_once dirname(__FILE__) . "/percent.php";
require_once dirname(__FILE__) . "/slug.php";
require_once dirname(__FILE__) . "/tags.php";
require_once dirname(__FILE__) . "/text.php";
require_once dirname(__FILE__) . "/textarea.php";

require_once dirname(__FILE__) . "/truefalse.php";
require_once dirname(__FILE__) . "/url.php";
require_once dirname(__FILE__) . "/video_id.php";
require_once dirname(__FILE__) . "/visible.php";
require_once dirname(__FILE__) . "/youtube-real.php";
require_once dirname(__FILE__) . "/youtube.php";
