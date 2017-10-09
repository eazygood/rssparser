<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title', 'description', 'link', 'pubDate'];
    public $timestamps = false;

    public function getTable() {
        return $this->table;
    }

    public function setTable($table) {
        $this->$table = $table;
    }

    public function setDataToDatabase($data) {
        $newData =  json_decode(json_encode($data), false);
        foreach ($data as $items => $arrays) {
            foreach ($arrays as $key => $arr) {
                if (isset($arr['title']) && isset($arr['description']) && isset($arr['link'])) {
                    News::updateOrCreate([
                        'title' => $arr['title'],
                    ],[
                        'title' => $arr['title'],
                        'description' => $arr['description'],
                        'link' => $arr['link'],
                        'pubDate' => $arr['pubDate']
                    ]);
                    
                 }
            }
          }
    }    
    

}
