<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id', 'course_id', 'start_date', 'end_date', 'is_active'
    ];

    public function scopeFilter($q)
    {
        $request = request();
        $query = $request->get('query', []);

//        if (isset($query['generalSearch'])) {
//            $q
//                ->whereHas('student', function ($q) use ($query) {
//                    $q->filter();
//                })
//                ->orWhereHas('course', function ($q) use ($query) {
//                    $q->filter();
//                });
//
//        }

        if (isset($query['course_id'])){
            $q->where('course_id', $query['course_id']);
        }

        if (isset($query['student_id'])){
            $q->where('student_id', $query['student_id']);
        }

    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
