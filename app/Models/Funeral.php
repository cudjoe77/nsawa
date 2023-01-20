<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funeral extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'tblfuneral';
    protected $primaryKey = 'fid';
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


    public function detail()
    {
    return $this->hasMany(FuneralDetail::class,'fid')->where('deleteflag','=' ,'0');
    }




    public function funDeath()
    {
        return $this->belongsToMany(Death::class,FuneralDetail::class,'fid','did')->where('tblfundetail.deleteflag','=','0');
    }
}
