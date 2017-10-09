<?php

namespace App\Http\Controllers;

use Redis;
use Cache;
use Illuminate\Http\Request;
use App\News;
use DB;
use Carbon\Carbon;

class XmlController extends Controller
{
    private $parser = [];
    private $appNews;
    private $cacheTime = 30;


    public function __construct(\App\News $appNews)
    {
        $this->appNews = $appNews;
    }

    public function xmlParser()
    {
        $url = 'http://err.ee/rss';
        $xml = simplexml_load_file($url, null, true);
        if (is_object($xml)) {
            $this->parser['items'] = [];
            $id = 1;
            foreach ($xml->channel->item as $item) {
                array_push($this->parser['items'], [
                    'id' => (int) $id,
                    'title' => (string) $item->title,
                    'link' => (string) $item->link,
                    'description' => (string) $item->description,
                    'pubDate' => (string) $item->pubDate
                ]);
                $id++;
            }
            // Sort DESC by id
            rsort($this->parser["items"], SORT_REGULAR);
        }
        return $this->parser;
    }

    public function infinityScroll(Request $request)
    {
        // Check cache
        $cache = Cache::get('news1');
        if ($cache == null) {
            $parser = $this->xmlParser();
            // Put news intp MySQL DB
            $this->appNews->setDataToDataBase($this->xmlParser());
        }
            // Check if Cache exists, then retrieve it from (Cache database(RedisDB)), if not then
            // retrieve it from Database and put it as a Cache into Redis DB for 30 minutes
            $news = Cache::remember('news'. (isset($_GET['page']) ? $_GET['page'] : 1), $this->cacheTime, function () {
                return \App\News::orderBy('id', 'desc')->paginate(10);
            });
           
        // If request going as AJAX then, response will generated template (data.blade.php)
        // in the folder news/ajax
        if ($request->ajax()) {
            return [
            'news' => view('news.ajax.data')->with(compact('news'))->render(),
            ];
        }
        // if not ajax then retireve constant page (index.blade.php) from the folder news/
        return view('news.index')->with(compact('news'));
    }
}
