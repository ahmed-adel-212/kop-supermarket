<?php  namespace App\Filters;

class ColorFilters extends QueryFilter
{
    public function from($value = null){
    	if ($value)
    		return $this->builder->whereDate('created_at', '>=', $value);
    }

	public function to($value = null){
    	if ($value)
    		return $this->builder->whereDate('created_at', '<=', $value);
    }
}
