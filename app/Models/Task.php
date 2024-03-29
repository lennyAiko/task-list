<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // for when you want to do mass assignment
    protected $fillable = ['title', 'description', 'long_description']; // this opens only what is in
    // protected $guarded = ['secret'] this protects only what is in

    public function toggleComplete() 
    {
        $this->completed = !$this->completed;
        $this->save();
    }
}
