<?php

namespace App\Providers;

use App\Models\Contacts;
use App\Policies\ContactPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Contacts::class => ContactPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // FacadesGate::define('update-post', function(User $user, Contacts $contacts) {
        //     return $user->id === $contacts->user_id;
        // });
    }
}
