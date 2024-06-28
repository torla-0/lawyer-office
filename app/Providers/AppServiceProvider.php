<?php

namespace App\Providers;

use App\Models\AdminQuery;
use App\Models\LegalCase;
use App\Policies\LegalCasePolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(LegalCase::class, LegalCasePolicy::class);
        Paginator::useBootstrap();

        if(ucfirst(Auth::user() && Auth::user()->role->name) == 'Admin')
        DB::listen(function($query) {
            AdminQuery::create([
                'admin_id' => auth()->id(), // ID trenutno prijavljenog admina
                'method' => $query->connection->getName(), // Naziv korišćene baze podataka
                'query' => $query->sql, // SQL upit koji je izvršen
            ]);
        });
        
    }
}
