<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;
    protected $table = 'tblcause';
    protected $primaryKey = 'cid';
    protected $guarded = [];
  
    // protected $fillable = [
    //     'vendor_name', 'vendor_address','contact_person','tel1','tel2','email','vendor_location','notes'
    // ];

    
    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%'.$value.'%');
    }
}