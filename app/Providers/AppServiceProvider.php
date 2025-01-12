<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Grant;
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
        Schema::defaultStringLength(191);
        Gate::define('isAdmin', function ($user) {
            return $user->userCategory === 'admin';
        });

        Gate::define('staffAdmin', function ($user) {
            return $user->userCategory === 'admin' || $user->userCategory === 'staff';
        });

        Gate::define('isStaff', function ($user) {
            return $user->userCategory === 'staff';
        });

        Gate::define('isAcademician', function ($user) {
            return $user->userCategory === 'academician';
        });

        Gate::define('AdminStaffAcademician', function ($user) {
            return $user->userCategory === 'admin' || 
            $user->userCategory === 'staff' || 
            $user->userCategory === 'academician';
        });

        /* Corrected Gate definition for "viewGrants"
        Gate::define('viewGrants', function ($user) {
            return $user->userCategory === 'admin' || 
                   $user->userCategory === 'staff' || 
                   $user->userCategory === 'academician';
        });*/
        /* Optional: Uncomment and fix this if you need a leader check
        Gate::define('isLeader', function ($user, $grantId) {
            return $user->academicians()
                ->wherePivot('role', 'leader')
                ->wherePivot('grant_id', $grantId)
                ->exists();
        });*/

        /*Gate::define('isLeader', function ($user, $grant) {
            return $grant->leader_id === $user->academician_id;
        });*/
        Gate::define('isLeader', function ($user) {
            // Check if the logged-in user is the leader for the given grant
            /*return Grant::whereHas('academicians', function ($query) use ($user) {
                            $query->where('user_id', $user->id)
                                  ->where('role', 'leader');
                        })->exists();*/
                        return Grant::whereHas('academicians', function ($query) use ($user) {
                            $query->where('user_id', $user->id)
                                  ->where('role', 'leader');
                        })->exists();
        });
    
       
    }

}

