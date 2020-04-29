 <?php

 use App\Mail\WelcomeMail;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Route;
 use Stevebauman\Location\Location;

 /*
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for your application. These
 | routes are loaded by the RouteServiceProvider within a group which
 | contains the "web" middleware group. Now create something great!
 |
 */


 Route::get('/email', function () {
     return new WelcomeMail();
 });
Auth::routes(['verify' => true]);
Route::get('/', 'firstpageController@index')->name('firstpage');
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/p/create', 'PostsController@create')->name('posts.create');
Route::post('/p', 'PostsController@store')->name('posts.store');
Route::get('/p/{post}', 'PostViewController@show')->name('posts.show');
Route::get('/profile/{user}/edit', 'EditProfile@index')->name('profile.edit');
Route::post('/edit', 'EditProfile@update')->name('profile.update');
Route::get('/query/{key}', 'firstpageController@see_paper')->name('query.show');
Route::get('test', 'Auth\RegisterController@ipfinder');
Route::redirect('profile.update', 'home');
