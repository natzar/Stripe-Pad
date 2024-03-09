<?

/**
 * Package Name: Stripe Pad
 * File Description: Main Controller for custom app
 * 
 * @author Beto Ayesa <beto.phpninja@gmail.com>
 * @version 1.0.0
 * @package StripePad
 * @license GPL3
 * @link https://github.com/natzar/stripe-pad
 * 
    
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    This file is part of Stripe Pad.

    Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

    Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
*/

# Load Environment
require_once dirname(__FILE__).'/../load.php'; 
    

# Each method of this class can be accessed from //your-domain/app/{method}?params=params

class App extends StripePad {
   
    
  /*  Admin Login
  ---------------------------------------*/
  public function __construct(){
        parent::__construct();

  }

     #Default app home page
    public function index(){      

        # check if user is authenticated
        if ($this->isAuthenticated()){          
            # Load Dashboard (main-first screen of your app for logged users)
            $this->app();
        }else{
            # Redirect to login if not authenticated
            $this->home();
        }
    }

    public function app(){
        if ($this->isAuthenticated()){     

            # Do here any logic your app needs
            # $model = new model(); /models files are already available

            
            $this->view->show('app.php',array(
                "any variable" => "you want to pass to the view"

            ));
        }else{
            $this->login();
        }   
    }
    
    public function home(){
        $data = array();        
        $this->view->show("landing/homepage.php",$data);      
    }

    public function installation(){
        $data = array();        
        $this->view->show("landing/installation.php",$data);      
    }

    public function dashboard(){
        $data = array();        
        $this->view->show("dashboard.php",$data);      
    }

 public function examples(){
        $data = Array();                    
        $this->view->show("landing/examples.php", $data);
    }

    public function sample(){
        $data = Array();                    
        $this->view->show("help.php", $data);
    }

  public function about(){
    $this->view->show('about.php',array(
        "SEO_TITLE" => "About Domstry"
    ));
  }
  public function tos(){
    $this->view->show('common/tos.php',array());
  }
  public function privacy(){
    $this->view->show('common/privacy.php',array());
  }


    public function blog(){
    
        $blog = new leadsModel();
        if (!empty($this->params['a'])):
            
            $slug = $this->params['a'];

            $q = $blog->db->prepare("SELECT *,DATE_FORMAT(created, '%d-%m-%Y') as created from blog where slug = :slug limit 1");
            $q->bindParam(":slug",$slug);
            $q->execute();
            $data = $q->fetch();
            
            $data['SEO_TITLE'] = $data['title']." - Domstry";
            $data['SEO_DESCRIPTION'] = truncate(strip_tags($data['body']));
            $this->view->show('views/blog-post.php',$data,false);
        else:
            
            $slug = $this->params['a'];

            $q = $blog->db->prepare("SELECT *,DATE_FORMAT(created, '%d-%m-%Y') as created from blog order by created DESC  ");      
            $q->execute();
            $data = array("items" => $q->fetchAll());

            $data['SEO_TITLE'] = "Resources - Domstry";
            $this->view->show('views/resources.php',$data);
        endif;
    }

    public function signup(){
        $data = array(
            
        );
        $this->view->show("user/signup.php",$data,true);
    }
    
    public function login(){      
        $data = Array();         

        # Login function

        # Login with Google
        // $client = new Google_Client();
        // $client->setClientId('YOUR_CLIENT_ID');
        // $client->setClientSecret('YOUR_CLIENT_SECRET');
        // $client->setRedirectUri('YOUR_REDIRECT_URI');
        // $client->addScope("email");
        // $client->addScope("profile");

        // $authUrl = $client->createAuthUrl();
        // echo "<a href='$authUrl'>Login with Google</a>";

        $this->view->show("user/login.php", $data,true);
    }
  
    public function forgotPassword(){      
        $data = Array();         
        $this->view->show("user/forgot-password.php", $data,false);
    }
}



