<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'tblcurrency';
    protected $primaryKey = 'currid';
    protected $guarded = [];

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%'.$value.'%');
    }


  

    // public function bulkdetail()
    // {
    // return $this->hasMany(BulkDetail::class,'batchid');
    // }

}
