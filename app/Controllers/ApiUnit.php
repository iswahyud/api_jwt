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

class ApiUnit extends ResourceController
{

	public function __construct()
	{
        // inisialisasi class Auth dengan $this->protect
		$this->protect = new ApiAuth();
		$this->units = new ApiUnitModel();
		$this->unit_images = new ApiUnitImagesModel();
	}

	public function index()
	{
        // ambil dari controller auth function public private key
        $secret_key = $this->protect->privateKey();

		$token = null;

		$authHeader = $this->request->getServer('HTTP_AUTHORIZATION');

		$arr = explode(" ", $authHeader);

		$token = $arr[1];

		if($token){

			try {
		
				$decoded = JWT::decode($token, $secret_key, array('HS256'));
		
				// Access is granted. Add code of the operation here 
                if($decoded){
                    // response true
                    $output = [
						'message' => 'Berhasil Login',
						'secret_key' => $decoded
                    ];
                    return $this->respond($output, 200);
                }
				
		
			} catch (\Exception $e){

				$output = [
					'message' => 'Access denied',
					"error" => $e->getMessage()
				];
		
				return $this->respond($output, 401);
			}
		}
	}

	//List Rumah
	public function unit()
	{
		$id = $this->request->getPost('id');
		if($id != null)
		{
			$list_data = $this->units->data_unit_byID($id);
		}
		else
		{
			$list_data = $this->units->data_unit();
		}

		// ambil dari controller auth function public private key
        $secret_key = $this->protect->privateKey();

		$token = null;

		$authHeader = $this->request->getServer('HTTP_AUTHORIZATION');

		$arr = explode(" ", $authHeader);

		$token = $arr[1];
		
		if($token){

			try {
		
				$decoded = JWT::decode($token, $secret_key, array('HS256'));
		
				// Access is granted. Add code of the operation here 
                if($decoded){
                    // response true
                    $output = [
						'message' => 200,
						'data' => [$list_data]
                    ];
                    return $this->respond($output, 200);
                }
				
		
			} catch (\Exception $e){

				$output = [
					'message' => 0,
					"error" => $e->getMessage()
				];
		
				return $this->respond($output, 401);
			}
		}
	}

	//foto rumah
	public function unit_images()
	{
		$id = $this->request->getPost('id_unit');
		if($id != null)
		{
			$list_data = $this->unit_images->data_unit_byID($id);
		}
		else
		{
			$list_data = $this->unit_images->data_unit();
		}

		// ambil dari controller auth function public private key
        $secret_key = $this->protect->privateKey();

		$token = null;

		$authHeader = $this->request->getServer('HTTP_AUTHORIZATION');

		$arr = explode(" ", $authHeader);

		$token = $arr[1];
		
		if($token){

			try {
		
				$decoded = JWT::decode($token, $secret_key, array('HS256'));
		
				// Access is granted. Add code of the operation here 
                if($decoded){
                    // response true
                    $output = [
						'message' => 200,
						'data' => $list_data
                    ];
                    return $this->respond($output, 200);
                }
				
		
			} catch (\Exception $e){

				$output = [
					'message' => 0,
					"error" => $e->getMessage()
				];
		
				return $this->respond($output, 401);
			}
		}
	}


}
