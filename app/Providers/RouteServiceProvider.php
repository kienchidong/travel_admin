<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller router.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $namespaceAdmin = 'App\Http\Controllers\Admin';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the router for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //

        /* route for admin */
        $this->mapAdminRoutes();
    }

    /**
     * Define the "web" router for the application.
     *
     * These router all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'locale'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" router for the application.
     *
     * These router are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware(['api','locale'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }


    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web', 'locale'])
            ->namespace($this->namespaceAdmin)
            ->group(base_path('routes/admin.php'));
    }
}
