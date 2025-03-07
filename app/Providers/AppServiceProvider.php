<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Paginator::useBootstrapFour();

    // Запись лога, если в .env APP_DEBUG = true
    // if (config('app.debug')) {
    //   DB::listen(fn ($query) => Log::info($query->sql, $query->bindings, $query->time));
    // }
  }
}
