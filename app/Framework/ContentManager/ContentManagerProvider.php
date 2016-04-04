<?php
/**
 * ContentManagerProvider.php
 *
 * Creator:         chongyi
 * Create Datetime: 2016/4/4 15:50
 */

namespace Inspirer\Framework\ContentManager;


use Illuminate\Support\ServiceProvider;

class ContentManagerProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ModelManager::class, function () {
            return ModelManager::getInstance();
        });
    }
}