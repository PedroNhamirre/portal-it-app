<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = ['id_post', 'id_user', 'content'];

    // Relacionamento com o post
    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    // Relacionamento com o usuário que fez o comentário, se aplicável
    // No modelo Comment
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    

}
