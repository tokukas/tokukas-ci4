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
            'faqTopics' => $this->FAQModel->topics(),
            'faqShowTopic' => $topic,
            'faqList' => $this->FAQModel->list($topic),
        ];

        return view('faq/index', $data);
    }
}
