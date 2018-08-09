<?php

namespace Modules\Firstyearinfo\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Firstyearinfo\Events\Handlers\RegisterFirstyearinfoSidebar;

class FirstyearinfoServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterFirstyearinfoSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('students', array_dot(trans('firstyearinfo::students')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('firstyearinfo', 'permissions');

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
            'Modules\Firstyearinfo\Repositories\StudentRepository',
            function () {
                $repository = new \Modules\Firstyearinfo\Repositories\Eloquent\EloquentStudentRepository(new \Modules\Firstyearinfo\Entities\Student());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Firstyearinfo\Repositories\Cache\CacheStudentDecorator($repository);
            }
        );
// add bindings

    }
}
