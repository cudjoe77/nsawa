<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'tbldeath';
    protected $primaryKey = 'did';
    protected $guarded = [];

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%'.$value.'%');
    }


     public function cause()
    {
    return $this->belongsTo(Cause::class,'d_cause');
    }

    public function family()
    {
    return $this->belongsTo(Family::class,'d_family');
    }

    // public function fundetail()
    // {
    // return $this->belongsTo(FuneralDetail::class,'did');
    // }


    public function fundetail()
    {
        return $this->belongsToMany(Funeral::class,FuneralDetail::class,'did','fid')->where('tblfundetail.deleteflag','=','0');
    }

  

}
