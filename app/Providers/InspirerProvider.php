<?php namespace App\Providers;

use App\Inspirer\PaginationPresenter;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\ServiceProvider;

class InspirerProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 创建 Xunsearch XS_APP_ROOT 常量
        define('XS_APP_ROOT', app_path('Inspirer/Xunsearch'));

        // 使用自定义分页模板
        Paginator::presenter(function (AbstractPaginator $paginator) {
            return new PaginationPresenter($paginator);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
