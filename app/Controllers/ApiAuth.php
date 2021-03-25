<?php namespace App\Controllers;

use \Firebase\JWT\JWT;
use App\Models\ApiAuthmodel;
use CodeIgniter\RESTful\ResourceController;

//Auth Customer
class ApiAuth extends ResourceController
{
	public function __construct()
	{
		$this->auth = new ApiAuthmodel();
	}

	public function privateKey()
	{
		$privateKey = <<<EOD
			-----BEGIN RSA PRIVATE KEY-----
			MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
			vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
			5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
			AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
			bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
			Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
			cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
			5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
			ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
			k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
			qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
			eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
			B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
			-----END RSA PRIVATE KEY-----
			EOD;
		return $privateKey;
	}

	//customer
	public function register()
	{
		$salt = "R4H4S14";

		$username 	= $this->request->getPost('username');
		$nama 	= $this->request->getPost('nama');
		$password 		= $this->request->getPost('password');
		$tipe 		= $this->request->getPost('tipe');
		$noktp 		= $this->request->getPost('noktp');
		$no_telp1 		= $this->request->getPost('no_telp1');
		$no_telp2 		= $this->request->getPost('no_telp2');
		$alamat 		= $this->request->getPost('alamat');
		$email1 		= $this->request->getPost('email1');
		$email2 		= $this->request->getPost('email2');
		$foto 		= $this->request->getPost('foto');
		$company 		= $this->request->getPost('company');
		$created_at 	= $this->request->getPost('created_at');
		$update_at 	= $this->request->getPost('update_at');

		$password_sha1 = sha1($salt.$password);

		$data = json_decode(file_get_contents("php://input"));

		$dataRegister = [
			'username' => $username,
			'nama' => $nama,
			'password' => $password_sha1,
			'tipe' => $tipe,
			'noktp' => $noktp,
			'no_telp1' => $no_telp1,
			'no_telp2' => $no_telp2,
			'alamat' => $alamat,
			'email1' => $email1,
			'email2' => $email2,
			'foto' => $foto,
			'company' => $company,
			'created_at' => $created_at,
			'update_at' => $update_at
		];

		$register = $this->auth->register_customer($dataRegister);

		if($register == true){
			$output = [
				'status' => 200,
				'message' => 'Berhasil register'
			];
    		return $this->respond($output, 200);
		} else {
			$output = [
				'status' => 400,
				'message' => 'Gagal register'
			];
    		return $this->respond($output, 400);
		}
	}

	//login customer
	public function login()
	{
		$salt = "R4H4S14";
		$username 	= $this->request->getPost('username');
		$password 	= $this->request->getPost('password');
		$cek_login  = $this->auth->cek_login_cust($username);

		if(sha1($salt.$password) == $cek_login['password'])
		{
			$secret_key = $this->privateKey();
			$issuer_claim = "THE_CLAIM"; // this can be the servername. Example: https://domain.com
			$audience_claim = "THE_AUDIENCE";
			$issuedat_claim = time(); // issued at
			$notbefore_claim = $issuedat_claim + 10; //not before in seconds
			$expire_claim = $issuedat_claim + 3600; // expire time in seconds
			$token = array(
				"iss" => $issuer_claim,
				"aud" => $audience_claim,
				"iat" => $issuedat_claim,
				"nbf" => $notbefore_claim,
				"exp" => $expire_claim,
				"data" => array(
					"id" => $cek_login['id'],
					"nama" => $cek_login['nama'],
					"username" => $cek_login['username'],
					"no_telp1" => $cek_login['no_telp1'],
					"tipe" => $cek_login['tipe']
				)
			);

			$token = JWT::encode($token, $secret_key);

			$output = [
				'status' => 200,
				'message' => 'Berhasil login',
				"token" => $token,
                "username" => $username,
                "expireAt" => $expire_claim
			];
			return $this->respond($output, 200);
		} else {
			$output = [
				'status' => 401,
				'message' => 'Login faileds',
				"password" => sha1($salt. $password) . '////' . $cek_login['password']
			];
			return $this->respond($output, 401);
		}
	}


}
