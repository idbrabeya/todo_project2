<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'name',
        'description',
        'user_type'
    ];

    public function tasks(){
        return $this->hasMany(Task::class, 'todo_id', 'id');
    }
}
