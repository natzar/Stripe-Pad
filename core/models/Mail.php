<?
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailsModel extends ModelBase {
    var $emailValidator;

    public function __construct(){
        $this->emailValidator = new emailValidator(); 

    }

    public function send($to, $subject, $body){

        if (!empty($to) and $this->emailValidator->isValid($to)):
        
            $mail = new PHPMailer();
            $mail->IsSMTP();                                      // Set mailer to use SMTP
            $mail->Host = SMTP_SERVER;                // Specify main and backup server
            
            $mail->Port = SMTP_PORT;                                    // Set the SMTP port
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = EMAIL_FROM;
            $mail->Password = EMAIL_PASSWORD;                  // SMTP password
            $mail->SMTPSecure = 'tsl';     
            $mail->SetFrom(EMAIL_FROM);
            $mail->IsHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->AddAddress($to);
            $mail->Subject = $subject;
            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
            $mail->MsgHTML($body); 
            
            return $mail->Send();

        endif; 
        return false;
    }
    
    function replaceTemplateValues($body,$p){
	
        foreach($p as $k => $v){
                if ($k == "persona_contacto"){ // Sin apellidossi
                    $v = explode(" ",$v);
                    $v = $v[0];
                }
                $body = str_replace("{{".$k."}}",$v,$body);
        }
    
        if (isset($p['persona_contacto'])) {
            $body = str_replace("{{persona_contacto_completo}}",$p['persona_contacto'],$body);	
        }
        
                
            
        $weekdays = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $body = str_replace("{{dia_semana}}",$weekdays[date("w")],$body);
        
        $body = str_replace("{{fecha_completa}}",Date("d/m/Y H:i:s"),$body);
    
        $body = str_replace("{{fecha}}",Date("d/m/Y"),$body);
    
        $body = str_replace(" ,",Date(","),$body);
    
        // Prevent errors
        $body = preg_replace('/\\{{2}(.*)\\}{2}/', '', $body);
        return $body;
    
    }
}