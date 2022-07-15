<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot(); // Obliger de faire un parent::boot() pour que la méthode boot() de Model soit appelée.

        self::creating(function ($post) { // A la création du post
            $post->user()->associate(auth()->user()->id); // J'associe l'utilisateur qui crée le post
            $post->category()->associate(request()->category);
        });

        self::updating(function ($post) { // A la mise à jour du post
            $post->category()->associate(request()->category);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getTitleAttribute($attribute)
    {
        return Str::title($attribute);
    }
}
