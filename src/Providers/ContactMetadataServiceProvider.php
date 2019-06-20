<?php

namespace Mailjet\LaravelMailjet\Providers;

use Illuminate\Support\ServiceProvider;
use Mailjet\LaravelMailjet\Services\ContactMetadataService;
use Mailjet\LaravelMailjet\Services\MailjetService;

class ContactMetadataServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Mailjet\LaravelMailjet\Contracts\ContactMetadataContract',
            function($app) {
            $config  = $this->app['config']->get('services.mailjet', array());
            $call    = $this->app['config']->get('services.mailjet.common.call',true);
            $options = $this->app['config']->get('services.mailjet.common.options', array());
            $mailjetService=new MailjetService($config['key'], $config['secret'], $call,$options);
            return new ContactMetadataService($mailjetService);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Mailjet\LaravelMailjet\Contracts\ContactMetadataContract'];
    }
}