<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    Fortify::registerView(function () {
      return view('auth.register');
    });

    Fortify::loginView(function () {
      return view('auth.login');
    });

    Fortify::requestPasswordResetLinkView(function () {
      return view('auth.password.request');
    });

    Fortify::resetPasswordView(function () {
      return view('auth.password.edit');
    });

    Fortify::verifyEmailView(function () {
      return view('auth.verify-email');
    });
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Fortify::createUsersUsing(CreateNewUser::class);
    Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
    Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
    Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

    RateLimiter::for('login', function (Request $request) {
      $email = (string) $request->email;

      return Limit::perMinute(5)->by($email . $request->ip());
    });

    RateLimiter::for('two-factor', function (Request $request) {
      return Limit::perMinute(5)->by($request->session()->get('login.id'));
    });
  }
}
