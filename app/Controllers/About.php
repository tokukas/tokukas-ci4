<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tentang Kami | TOKUKAS',
            'variable' => $this->variable,
            'pageDesc' => 'TOKUKAS adalah sebuah toko yang menawarkan buku-buku bekas dengan harga yang terjangkau. TOKUKAS hadir di beberapa platform e-commerce populer di Indonesia, seperti Shopee dan Tokopedia.',
        ];

        return view('about/index', $data);
    }
}
