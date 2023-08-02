<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
  public function __invoke()
  {
    if (auth()->user()) {
      return redirect()->route('dashboard');
    }

    return view('welcome');
  }
}
