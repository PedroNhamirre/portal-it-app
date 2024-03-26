<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_post', // adicione o campo 'id_post' à lista de atribuições em massa
        'id_user', // outros campos que você deseja permitir atribuições em massa
        // ... outros campos do seu modelo View
    ];
}
