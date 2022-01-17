<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    protected $with = ['user','category','photos','tags'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function photos(){
        return $this->hasMany(Photo::class,'post_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //accessor
//    public function getTitleAttribute($value){
//        return Str::words($value,10,'...');
//    }

    public function getShortTitleAttribute(){
        return Str::words($this->title,10,'...');
    }

    public function getShowTimeAttribute(){
        return '<p class="small mb-0">
                   <i class="fas fa-calendar"></i>
                   '.$this->created_at->format("d-m-Y").'
                </p>
                <p class="small mb-0">
                   <i class="fas fa-clock"></i>
                   '.$this->created_at->format("h:i a").'
                </p>';
    }


    //mutator
    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug($value);
    }

    //event
//    protected static function booted()
//    {
//        static::created(function (){
//            logger("hello");
//        });
//    }

    //local query scope
    public function scopeSearch($query){
        if(request()->search){
            $search = request()->search;
            return $query->where('title','LIKE',"%$search%")->orwhere('description','LIKE',"%$search%");
        }
    }
}
