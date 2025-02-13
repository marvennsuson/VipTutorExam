<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('not_deleted', function (Builder $builder) {
            $builder->whereNull('deleted_at');
        });
    }

 

    public function scopeWithoutDeleted(Builder $query)
    {
        return $query->withoutGlobalScope('not_deleted');
    }

    // public function User(){
    //     return $this->belongsTo(User::class,'user_id');
    // }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
