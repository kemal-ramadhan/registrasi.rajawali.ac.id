<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class FortifyResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, function () {
            return new class implements LoginResponseContract {
                public function toResponse($request)
                {
                    $user = Auth::user();
                    
                    switch ($user->role) {
                        case 'Admin':
                            $redirect = '/dashboard';
                            break;
                        case 'BK':
                            $redirect = '/bk';
                            break;
                        case 'Customer':
                            $redirect = '/';
                            break;
                        default:
                            $redirect = '/';
                            break;
                    }

                    return redirect($redirect);
                }
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
