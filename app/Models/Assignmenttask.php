<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignmenttask extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'user_id',
        'task_id',
        'status'
        
    ];
    // protected $casts = [
    //     'user_id' => 'array'
    // ];
    public function tasktoassign(){
        return $this->belongsTo(Task::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function users(){
        return $this->belongsToMany(User::class, 'id', 'user_id');
    }
    public function task(){
        return $this->belongsTo(Task::class);
    }
}
