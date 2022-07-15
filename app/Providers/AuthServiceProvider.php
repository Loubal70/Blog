<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate pour vérifier l'update du model post si l'utilisateur est le créateur du post
        // Si oui, il peut le modifier, exemple :
        // if(Gate::denies('update-post', $post)) {
        //     abort(403);
        // }

        Gate::define('update-post', function(User $user, Post $post) {
            return $user->id == $post->user_id;
        });

        Gate::define('destroy-post', function(User $user, Post $post) {
            return $user->id == $post->user_id;
        });
    }
}
