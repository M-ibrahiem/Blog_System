<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });


        Route::bind('user', function($value){
            return User::withTrashed()->where('id', $value)->firstOrFail();
        });

        Route::bind('category',function($value){
            return Category::withTrashed()->where('id',$value)->firstOrFail();
        });
        Route::bind('post',function($value){
            return Post::withTrashed()->where('id',$value)->firstOrFail();
        });
    }
}
