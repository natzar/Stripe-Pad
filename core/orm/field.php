<?



abstract class field{
	
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
   
   public final function __construct($fieldname,$label,$type,$value,$table = -1,$rid = -1){
        $this->db = SPDO::singleton();

		$this->label = $label;
		$this->fieldname = $fieldname;
		$this->type = $type;
		$this->value = $value;
		$this->table = $table;
		$this->rid = $rid;
   
   }
	
	
}

/* Include field types */
require_once dirname(__FILE__)."/temperature.php";
require_once dirname(__FILE__)."/leadsstatus.php";
require_once dirname(__FILE__)."/color.php";
require_once dirname(__FILE__)."/time_spent.php";
require_once dirname(__FILE__)."/float.php";
require_once dirname(__FILE__)."/running.php";
require_once dirname(__FILE__)."/combo.php";
require_once dirname(__FILE__)."/customers.php";
require_once dirname(__FILE__)."/webs.php";
require_once dirname(__FILE__)."/developers.php";
require_once dirname(__FILE__)."/ticketstatus.php";
require_once dirname(__FILE__)."/products.php";
require_once dirname(__FILE__)."/combo_child.php";
require_once dirname(__FILE__)."/dias_semana.php";
require_once dirname(__FILE__)."/disabled.php";
require_once dirname(__FILE__)."/progress.php";
require_once dirname(__FILE__)."/horario.php";
require_once dirname(__FILE__)."/email.php";
require_once dirname(__FILE__)."/featured.php";
require_once dirname(__FILE__)."/fecha.php";
require_once dirname(__FILE__)."/fechahora.php";
require_once dirname(__FILE__)."/file_file.php";
require_once dirname(__FILE__)."/file_img.php";
require_once dirname(__FILE__)."/file_img_multi.php";
require_once dirname(__FILE__)."/file_swf.php";
require_once dirname(__FILE__)."/flash.php";
require_once dirname(__FILE__)."/float.php";
require_once dirname(__FILE__)."/hora.php";
require_once dirname(__FILE__)."/literal.php";
require_once dirname(__FILE__)."/mp3.php";
require_once dirname(__FILE__)."/multiselect.php";
require_once dirname(__FILE__)."/number.php";
require_once dirname(__FILE__)."/password.php";
require_once dirname(__FILE__)."/percent.php";
require_once dirname(__FILE__)."/slug.php";
require_once dirname(__FILE__)."/tags.php";
require_once dirname(__FILE__)."/text.php";
require_once dirname(__FILE__)."/textarea.php";
require_once dirname(__FILE__)."/tinymce.php";
require_once dirname(__FILE__)."/truefalse.php";
require_once dirname(__FILE__)."/url.php";
require_once dirname(__FILE__)."/video_id.php";
require_once dirname(__FILE__)."/visible.php";
require_once dirname(__FILE__)."/youtube-real.php";
require_once dirname(__FILE__)."/youtube.php";
require_once dirname(__FILE__)."/profesores.php";
require_once dirname(__FILE__)."/pedido.php";