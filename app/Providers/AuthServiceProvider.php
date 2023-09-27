<?php

namespace App\Providers;

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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Implicitly grant 'super-admin' role all permission checks using can()
        // gunakan metode Gate::before untuk mendefinisikan logika yang akan dijalankan sebelum mengevaluasi permission yang diminta,
        // $user merupakan param pertama yang sedang mencoba melakukan tindakan yang memerlukan permission,
        // $ability merupakan param kedua untuk tindakan yang akan di evaluasi permissionnya
        Gate::before(function ($user, $ability) {
            // cek apakah user mempunyai role super-admin
            if ($user->hasRole(env('APP_SUPER_ADMIN', 'super-admin'))) {
                // jika iya, maka mengembalikan nilai true, maka user diberi izin khusus tanpa perlu mengevaluasi izin lebih lanjut 
                return true;
            }
        });
    }
}
