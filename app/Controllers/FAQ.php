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
        $topics = $this->FAQModel->topics();

        $data = [
            'title' => 'FAQ | TOKUKAS',
            'loginSession' => session('login'),
            'faqTopics' => $topics,
            'faqShowTopic' => $topic,
            'faqList' => $this->FAQModel->list($topic),
        ];

        return view('faq/index', $data);
    }
}
