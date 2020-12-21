<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Support\Str;

abstract class Filter
{

    public function handle($request, Closure $next)
    {
        $builder = $next($request);
        if (!request()->has($this->filterName())) {
            return $builder;
        }
        if (request($this->filterName()) === null || request($this->filterName()) === "") {
            return $builder;
        }
        return $this->applyFilter($builder);
    }

    public abstract function applyFilter($builder);

    public function filterName()
    {
        return Str::snake(class_basename($this));
    }
}
