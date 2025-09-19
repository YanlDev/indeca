<?php

namespace App\Models;

use App\Enums\CourseStatus;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'status',
        'image_path',
        'video_path',
        'welcome_message',
        'goodbye_message',
        'observation',
        'user_id',
        'level_id',
        'category_id',
        'price_id',
        'published_at',
    ];

    protected $casts = [
        'status' => CourseStatus::class,
        'published_at' => 'datetime',
    ];
//Accessor de imagenes

    protected function image():Attribute{
        return new Attribute(
            get:function (){
                return $this->image_path ? Storage::url($this->image_path): 'https://cdn15.metasync.com/8O8Yppef7vG0m4r16gJ1trxr4u7V_-hJtO8SNK5kovN98xyzXZndSg==';
            }
        );
    }


//    Relaciones
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
    public function level(){
        return $this->belongsTo(Level::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function price(){
        return $this->belongsTo(Price::class);
    }




}
