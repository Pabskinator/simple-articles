<?php

namespace App\Http;

class ArticleFilter extends QueryFilter
{
    public function title($title){
        return $this->builder->where('title','LIKE','%'.$title.'%');
    }
}
?>
