<?php

namespace App\Providers;
use App\User;
use App\Policies\UserPolicy;
use App\UserRoles;
use App\UserRolesPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        UserRoles::class  => UserRolesPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return $user->role_id == 1;
        });

        Gate::define('isMarketingManager', function ($user) {
            return $user->role_id == 2;
        });

        Gate::define('isMarketingCoordinator', function ($user) {
            return $user->role_id == 3;
        });

        Gate::define('isStudent', function ($user) {
            return $user->role_id == 4;
        });

        Gate::define('isGuest', function ($user) {
            return $user->role_id == 5;
        });
    }
}
