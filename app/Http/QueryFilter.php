<?php

namespace App\Http;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $builder;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters($this->builder) as $name => $value) {
            if(method_exists($this, $name) && ($value !== null)){

                $params = array_filter([$value]);
                if($value === 0) {
                    $params[] = 0;
                }

                call_user_func_array([$this, $name], $params);
            }
        }

        return $this->builder;
    }

    public function filters(Builder $builder)
    {
        return $this->request->all();
    }
}

?>
