<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Firebase/JWT/JWT.php';

use Restserver\Libraries\REST_Controller;
use Firebase\JWT\JWT;

class Auth extends REST_Controller {

	private $secretKey = "psho";

    function __construct() {
        parent::__construct();
        $this->load->model('AdminModel', 'Admin');
    }
	
	public function login_post()
	{
		if ($this->post('email') == null) {
			return $this->response([
				'success' => false,
				'message' => "Field email harus diisi",
			], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
		}
		if (!filter_var($this->post('email'), FILTER_VALIDATE_EMAIL)) {
			return $this->response([
				'success' => false,
				'message' => "Email tidak valid",
			], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
		}
		if ($this->post('password') == null) {
			return $this->response([
				'success' => false,
				'message' => "Field password harus diisi",
			], REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
		}

		$params = [
			'email' => $this->post('email'),
			'password' => md5($this->post('password')),
		];
		if (($data = $this->Admin->singleWhere($params)) == null) {
			return $this->response([
				'success' => false,
				'message' => "Email atau Password Salah",
			], REST_Controller::HTTP_NOT_FOUND);
		}

		$dateTime = new DateTime();

		$payload = [];
		$payload['id'] = $data->id;
		$payload['email'] = $data->email;
		$payload['iat'] = $dateTime->getTimestamp();
		$payload['exp'] = $dateTime->getTimestamp() + 3600;

		return $this->response([
            'success' => true,
            'message' => "Login Berhasil",
            'data' => [
				'admin' => $data,
				'token' => JWT::encode($payload, $this->secretKey)
			]
        ], REST_Controller::HTTP_OK);
	}
}
