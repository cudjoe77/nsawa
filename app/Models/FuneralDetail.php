<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuneralDetail extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'tblfundetail';
    protected $primaryKey = 'detail_id';
    protected $guarded = [];
    
  
    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%'.$value.'%');
    }


    public function dead()
    {
    return $this->belongsTo(Death::class,'did');
    }

   
}
