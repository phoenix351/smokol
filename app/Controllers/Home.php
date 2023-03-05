<?php

namespace App\Controllers;


class Home extends BaseController
{

	public function index()
	{


		$sum_ = $this->barang_model->getKondisiSum(null);
		$data = [
			'barang_it'  => $this->barang_it_model->getBarangByUser(null),

			'sum' => $sum_,
			'title' => 'Daftar Barang',
			"app_name" => $this->app_name,
			"page_name" => "Dashboard",
			"uri" => $this->uri
		];

		return view('user/index', $data);
	}
}
