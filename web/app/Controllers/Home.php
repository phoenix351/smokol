<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			"app_name" => "SIMOKAD",
			"page_name" => "Dashboard",
		];
		return view('auth/index', $data);
	}
}
