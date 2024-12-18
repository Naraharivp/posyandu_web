<?php

namespace App\Providers;

use App\Models\poli_tsds;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $dataSide = poli_tsds::select('slug', 'nama_poli_tsd')->get();
        view()->share('dataSide', $dataSide);
    }
}
