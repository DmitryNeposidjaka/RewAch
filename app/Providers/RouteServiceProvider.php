<?php

namespace App\Providers;

use App\Models\Achievement;
use App\Models\Category;
use App\Models\Reward;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('entity', function ($value) {
            $current_route = Route::current();

            if ($current_route->named('approve.achievement*')) {
                return Achievement::findOrFail($value);
            } elseif ($current_route->named('approve.reward*')) {
                return Reward::findOrFail($value);
            } elseif ($current_route->named('achievement.attach.category') || $current_route->named('achievement.detach.category')) {
                return Category::findOrFail($value);
            } elseif ($current_route->named('achievement.attach.tag') || $current_route->named('achievement.detach.tag')) {
                return Tag::findOrFail($value);
            } else {
                abort(404);
                return null;
            }
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
