<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Platform;
use App\Models\Topic;
use App\Models\Author;
use App\Models\Series;
use App\Models\course;
use App\Models\Review;

class Course extends Model
{
    use HasFactory;

    public function submittedBy(){
        return $this->belongsTo(User::class,'submited_by');
    }

    public function platform(){
        return $this->belongsTo(Platform::class);
    }

    public function series(){
        return $this->belongsToMany(Series::class,'course_series','course_id','series_id');
    }

    public function topics(){
        return $this->belongsToMany(Topic::class,'course_topic','course_id','topic_id');
    }

    public function authors(){
        return $this->belongsToMany(Author::class,'course_author','course_id','author_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function duration($value){
        if($value ==1){
            return '5-10 hours';
        }
        elseif ($value == 2){
            return '10+ hours';
        }
        else{
            return '1-5 hours';
        }
        
    }

    public function difficulty_level($value){
        if($value ==1){
        return 'Itermidiate';
        }
        elseif ($value == 2){
            return 'Advanced';
        }
        else{
            return 'Beginer';
        }
    }
}
