<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $guarded = ['user_id'];

    public function feedback()
    {
        return $this->belongsTo(FeedBack::class, 'feedback_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
