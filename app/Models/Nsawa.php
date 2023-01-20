<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nsawa extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'tblfundonation';
    protected $primaryKey = 'pkid';
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
    return $this->belongsTo(Death::class,'did')->with(['family','cause']);
    }




     public function funeral()
    {
    return $this->belongsTo(Funeral::class,'fid');
    }

    public function currency()
    {
    return $this->belongsTo(Currency::class,'currid');
    }

    public function beneficiary()
    {
    return $this->belongsTo(Beneficiary::class,'benefit_id');
    }

    public function user()
    {
    return $this->belongsTo(User::class,'userid');
    }



    
    // public function bulkdetail()
    // {
    // return $this->hasMany(BulkDetail::class,'batchid');
    // }

  

}
