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
 *  
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.

 * This file is part of Stripe Pad.

    Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

    Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */

# SAMPLE APP
# Use this class to Override any core method /core/StripePad.php
# From here its yours


# Each method of this class can be accessed from //your-domain/app/{method}?params=params

class App extends StripePad
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {

    # check if user is authenticated
    if ($this->isAuthenticated) {
      # Load Dashboard (main-first screen of your app for logged users)
      $this->app();
    } else {
      # Redirect to login if not authenticated, or to home or landing
      $this->home();
    }
  }

  /**
   * app
   * If a registered user logs in, this method will be called
   * @return void
   */
  public function app()
  {
    # 
    # YOUR CODE GOES HERE :

    # Sample render of view with $data
    $data = array(
      "user" => $_SESSION['user'], # user->name, user->email, user->active (have paid 1/0)
      "date" => Date("Y-m-d"),
      "xyz" => 123
    );

    # show app/views/index.php passing $data
    $this->view->show('index.php', $data);
  }
  public function home()
  {
    $data = array();
    $this->view->show("landing/homepage.php", $data);
  }

  public function installation()
  {
    $data = array();
    $this->view->show("landing/installation.php", $data);
  }

  public function examples()
  {
    $data = array();
    $this->view->show("landing/examples.php", $data);
  }

  public function sample()
  {
    $data = array();
    $this->view->show("sample-page.php", $data);
  }


  public function tos()
  {
    $this->view->show('common/tos.php', array());
  }
  public function privacy()
  {
    $this->view->show('common/privacy.php', array());
  }


  public function blog()
  {
    include ROOT_PATH . "modules/blog/blog.php";
    $blog = new blog();


    if (!empty($this->params['a'])):

      $slug = $this->params['a'];
      //  $blog = new blogModel();
      $q = $blog->db->prepare("SELECT *,DATE_FORMAT(created, '%d-%m-%Y') as created from blog where slug = :slug limit 1");
      $q->bindParam(":slug", $slug);
      $q->execute();
      $data = $q->fetch();

      $data['SEO_TITLE'] = $data['title'] . " - Domstry";
      $data['SEO_DESCRIPTION'] = truncate(strip_tags($data['body']));
      $this->view->show('views/blog-post.php', $data, false);
    else:

      $slug = $this->params['a'];

      // $q = $blog->db->prepare("SELECT *,DATE_FORMAT(created, '%d-%m-%Y') as created from blog order by created DESC  ");
      $q->execute();
      $data = array("items" => $q->fetchAll());

      $data['SEO_TITLE'] = "Resources - Domstry";
      $this->view->show('views/resources.php', $data);
    endif;
  }
}
