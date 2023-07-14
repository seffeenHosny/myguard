<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $NewsService;
    public function __construct(NewsService $NewsSer)
    {
        $this->NewsService = $NewsSer;
    }

    public function show(News $news){
        return view('company.show_news' , compact('news'));
    }
}
