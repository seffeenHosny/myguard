<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\News;
use App\Repositories\NewsRepository;
use Auth;

class NewsService
{

    protected $News;
    public function __construct(News $News)
    {
        $this->News = new NewsRepository($News);
    }

    public function index()
    {
        return $this->News->index();
    }

    public function indexWithRelation($relation ,$select=null)
    {
        return $this->News->indexWithRelation($relation ,$select);
    }

    public function store($request)
    {
        return $this->News->store($request);
    }

    public function show($id)
    {
        return $this->News->show($id);
    }

    public function update($id, $request)
    {
        return $this->News->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->News->destroy($id);
    }

}
