<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'TOKUKAS | Toko Buku Bekas',
			'loginSession' => session('login'),
		];

		return view('home/index', $data);
	}
}
