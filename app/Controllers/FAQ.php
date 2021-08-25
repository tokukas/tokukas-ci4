<?php

namespace App\Controllers;

use App\Models\FAQModel;

class FAQ extends BaseController
{
    protected $FAQModel;

    public function __construct()
    {
        $this->FAQModel = new FAQModel();
    }

    public function index($topic = '')
    {
        $data = [
            'title' => 'FAQ | TOKUKAS',
            'loginSession' => session('login'),
            'variable' => $this->variable,
            'pageDesc' => 'Daftar pertanyaan yang sering diajukan (FAQ) kepada TOKUKAS',
            'faqTopics' => $this->FAQModel->topics(),
            'faqShowTopic' => $topic,
            'faqList' => $this->FAQModel->list($topic),
        ];

        return view('faq/index', $data);
    }
}
