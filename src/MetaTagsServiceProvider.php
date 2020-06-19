<?php

namespace Lotarbo\MetaTags;

use Illuminate\Support\ServiceProvider;

class MetaTagsServiceProvider extends ServiceProvider
{

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/meta-tags.php', 'meta-tags');

        $this->app->singleton(
            MetaTags::class,
            function ($app) {
                return new MetaTags(config('meta-tags'));
            }
        );
    }
}
