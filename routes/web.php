<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomeController::class);

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/dashboard', DashboardController::class);
  Route::get('/settings/profile-information', ProfileController::class)->name('user-profile-information.edit');
  Route::get('/settings/password', PasswordController::class)->name('user-password.edit');

  Route::resource('/contacts', ContactController::class);
  Route::delete('/contacts/{contact}/restore', [ContactController::class, 'restore'])
    ->name('contacts.restore')
    ->withTrashed();
  Route::delete('/contacts/{contact}/force-delete', [ContactController::class, 'forceDelete'])
    ->name('contacts.force-delete')
    ->withTrashed();

  Route::resource('/contacts.notes', ContactNoteController::class)->shallow();

  Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active',
  ]);

  Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
  ]);

  Route::resource('/companies', CompanyController::class);
  Route::delete('/companies/{company}/restore', [CompanyController::class, 'restore'])
    ->name('companies.restore')
    ->withTrashed();
  Route::delete('/companies/{company}/force-delete', [CompanyController::class, 'forceDelete'])
    ->name('companies.force-delete')
    ->withTrashed();

  // Динамический роут с ОПЦИОНАЛЬНЫМ параметром
  Route::get('/companies/{name?}', function ($name = null) {
    if ($name) {
      return "<h1>Company " . $name . " </h1>";
    } else {
      return "<h1>All Companies</h1>";
    }
  })->whereAlphaNumeric('name');
});

// Route::get('/dashboard', DashboardController::class)->middleware(['auth']);

// Eager loading
Route::get('/eagerload-multiple', function () {
  // Default
  // $users = User::get();

  // Eager
  $users = User::with(['companies', 'contacts'])->get();

  foreach ($users as $key => $user) {
    echo $user->name . ': ';
    echo $user->companies->count() . ' companies, ' . $user->contacts->count() . ' contacts <br /><br />';
  }
});

Route::get('/eagerload-nested', function () {
  // Default
  // $users = User::get();

  // Eager
  $users = User::with(['companies', 'companies.contacts'])->get();

  foreach ($users as $key => $user) {
    echo '<b>' . $user->name  . '</b>' . '<br />';

    foreach ($user->companies as $key => $company) {
      echo $company->name . '<b> has </b>' . $company->contacts->count() . ' contacts <br />';
    }

    echo '<br /><br />';
  }
});

Route::get('/eagerload-constraint', function () {
  // Default
  // $users = User::get();

  // Eager
  $users = User::with(['companies' => function ($query) {
    $query->where('email', 'like', '%.org');
  }])->get();

  foreach ($users as $key => $user) {
    echo '<b>' . $user->name  . '</b>' . '<br />';

    foreach ($user->companies as $key => $company) {
      echo $company->email . '<br />';
    }

    echo '<br /><br />';
  }
});

Route::get('/eagerload-lazy', function () {
  // Default
  $users = User::get();

  // Eager
  // $users->load('companies');

  // Eager with constraint
  $users->load(['companies' => function ($query) {
    $query->orderBy('name');
  }]);

  foreach ($users as $key => $user) {
    echo '<b>' . $user->name  . '</b>' . '<br />';

    foreach ($user->companies as $key => $company) {
      echo $company->name . '<br />';
    }

    echo '<br /><br />';
  }
});

Route::get('/eagerload-default', function () {
  // Default
  // $users = User::get();

  // Иногда при дефолтной установке Eager - получаются ненужные загрузки.
  // Как в данном случае, если нижний фразмент закомментирован:
  // подгрузка компаний и контактов всё равно происходит.
  // Для избежания этого, используется такой запрос:
  $users = User::without('contacts', 'companies')->get();

  foreach ($users as $key => $user) {
    echo '<b>' . $user->name  . '</b>' . '<br />';



    // foreach ($user->companies as $key => $company) {
    //   echo $company->email . '<br />';
    // }

    // echo '<br /><br />';
  }
});

// Counting related models
Route::get('/count-models', function () {
  // Default
  // $users = User::get();

  // Eager
  // $users = User::withCount(['companies', 'contacts'])->get();

  // В attributes добавятся 2 параметра с кол-вом:
  // companies_count
  // contacts_count
  // dd($users);

  // Eager with custom name for new atributes
  $users = User::withCount(['companies as company_numbers', 'contacts as contact_numbers'])->get();

  foreach ($users as $key => $user) {
    echo '<b>' . $user->name  . '</b>' . '<br />';

    // Default
    // echo '<b>' . $user->companies->count()  . '</b>' . ' companies <br />';
    // echo '<b>' . $user->contacts->count()  . '</b>' . ' contacts <br />';

    // Eager
    // echo '<b>' . $user->companies_count  . '</b>' . ' companies <br />';
    // echo '<b>' . $user->contacts_count  . '</b>' . ' contacts <br />';

    // Eager with custom name for new parameters
    echo '<b>' . $user->company_numbers  . '</b>' . ' companies <br />';
    echo '<b>' . $user->contact_numbers  . '</b>' . ' contacts <br />';

    echo '<br /><br />';
  }
});

Route::get('/count-models-constraint', function () {
  // Default
  // $users = User::get();

  // Eager
  $users = User::withCount(['companies' => function ($query) {
    $query->where('email', 'like', '%@gmail.com');
  }, 'contacts'])->get();

  foreach ($users as $key => $user) {
    echo '<b>' . $user->name  . '</b>' . '<br />';

    // Default
    // echo '<b>' . $user->companies->count()  . '</b>' . ' companies <br />';
    // echo '<b>' . $user->contacts->count()  . '</b>' . ' contacts <br />';

    // Eager
    echo '<b>' . $user->companies_count  . '</b>' . ' companies <br />';
    echo '<b>' . $user->contacts_count  . '</b>' . ' contacts <br />';

    echo '<br /><br />';
  }
});
