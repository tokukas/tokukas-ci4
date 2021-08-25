<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'TOKUKAS | Toko Buku Bekas',
			'loginSession' => session('login'),
			'variable' => $this->variable,
			'pageDesc' => 'Menjual berbagai macam buku bekas dengan harga terjangkau, karena #YangBekasPastiLebihMurah.'
		];

		return view('home/index', $data);
	}
}
