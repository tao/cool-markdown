<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Statamic\Statamic;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use Statamic\Facades\Markdown;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Default Markdown config
     */
    protected $markdownConfig = [
        'footnote' => [
            'container_add_hr' => false,
        ],
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $config = $this->markdownConfig;

        Markdown::extend('footnotes', function ($parser) use ($config) {
            return $parser
                ->newInstance($config)
                ->addExtensions(function () {
                    return [new FootnoteExtension];
                });
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
