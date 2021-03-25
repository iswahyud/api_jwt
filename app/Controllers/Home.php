<?php namespace App\Controllers;

// Panggil JWT
use \Firebase\JWT\JWT;
// panggil class Auth
use App\Controllers\ApiAuth;
// model
use App\Models\ApiUnitModel;
use App\Models\ApiUnitImagesModel;
// panggil restful api codeigniter 4
use CodeIgniter\RESTful\ResourceController;

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class Home extends ResourceController
{

	public function __construct()
	{
	}

	//List Rumah
	public function index()
	{
		echo "Halo";
	}



}
