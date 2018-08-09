<?php

namespace Modules\Colorgenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Colorgenerator\Events\Handlers\RegisterColorgeneratorSidebar;

class ColorgeneratorServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterColorgeneratorSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('students', array_dot(trans('colorgenerator::students')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('colorgenerator', 'permissions');

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
            'Modules\Colorgenerator\Repositories\StudentRepository',
            function () {
                $repository = new \Modules\Colorgenerator\Repositories\Eloquent\EloquentStudentRepository(new \Modules\Colorgenerator\Entities\Student());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Colorgenerator\Repositories\Cache\CacheStudentDecorator($repository);
            }
        );
// add bindings

    }
}
