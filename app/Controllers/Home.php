<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'TOKUKAS | Toko Buku Bekas'
		];

		return view('home/index', $data);
	}
}
