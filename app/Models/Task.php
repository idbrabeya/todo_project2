<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable=[
        'status',
        'prioriti',
        'assigne_to',
        'todo_id',
        'user_name',
        'task_name',
        'start_date',
        'end_date',
        'created_by'
    ];
        public function todorelation(){
        return $this->belongsTo(Todo::class,'todo_id','id');
    }
    public function todo(){
        return $this->belongsTo(Todo::class, 'todo_id','id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','assigne_to');
    }
    public function assignmenttask(){
        return $this->hasMany(Assignmenttask::class);
    }

}
