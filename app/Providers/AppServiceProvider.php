<?php

namespace App\Providers;

use App\Enums\AppRole;
use App\Models\User;
use App\Services\MailService;
use App\Services\TicketService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MailService::class, function () {
            return new MailService();
        });
        $this->app->bind(TicketService::class, function () {
            return new TicketService($this->app->make(MailService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define("admin", function (User $user) {
            return $user->roles()->where("name", AppRole::Admin)->count() > 0;
        });
        Gate::define("agent", function (User $user) {
            return $user->roles()
                ->where("name", AppRole::Agent)
                ->orWhere("name", AppRole::Admin)->count() > 0;
        });
        Gate::define("client", function (User $user) {
            return $user->roles()
                ->where("name", AppRole::Client)
                ->orWhere("name", AppRole::Agent)
                ->orWhere("name", AppRole::Admin)->count() > 0;
        });
    }
}
