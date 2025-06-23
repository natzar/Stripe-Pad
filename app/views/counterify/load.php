<?
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);	
require 'lib/Config.php';
require 'config.php';
require 'lib/View.php';
require 'lib/SPDO.php';
require 'lib/ModelBase.php';
require_once 'lib/functions.php';
require_once "../core/vendor/autoload.php";
require "../modules/emailValidator/emailValidator.php";
require "models/customersModel.php";
require "models/mailsModel.php";
require "models/usersModel.php";
require "models/datatrackerModel.php"; 
require "models/counterModel.php"; 
require "models/groupModel.php"; 