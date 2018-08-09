<?php

namespace Modules\Oldcpsk\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Oldcpsk\Events\Handlers\RegisterOldcpskSidebar;

class OldcpskServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterOldcpskSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('students', array_dot(trans('oldcpsk::students')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('oldcpsk', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Oldcpsk\Repositories\StudentRepository',
            function () {
                $repository = new \Modules\Oldcpsk\Repositories\Eloquent\EloquentStudentRepository(new \Modules\Oldcpsk\Entities\Student());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Oldcpsk\Repositories\Cache\CacheStudentDecorator($repository);
            }
        );
// add bindings

    }
}
