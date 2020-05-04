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
//home section
Route::get('/', 'firstpageController@index')->name('firstpage');// very first page
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');//home
 //profile section
Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');//profile showing
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');//profile edit
Route::post('/edit', 'ProfileController@update')->name('profile.update');//profile edit process
 //posts section
Route::get('/p/create', 'PostsController@create')->name('posts.create');//posts
Route::post('/p', 'PostsController@store')->name('posts.store');//posts storing process
Route::get('/p/{posts}', 'PostsController@showdata')->name('posts.show'); //posts show
 //query section
Route::get('/query/{key}', 'firstpageController@see_paper')->name('query.show');//paper see query 1st page
Route::get('test', 'Auth\RegisterController@ipfinder');//track the location
//review section
Route::get('p/{posts}/review', 'ReviewController@index')->name('posts.reviews'); //review page
Route::get('p/{posts}/review/reviewform', 'ReviewController@form')->name('reviews.edit'); //review writing
Route::post('p/{posts}/r', 'ReviewController@update')->name('reviews.update'); //review posts
Route::get('p/{posts}/review/{user}','ReviewController@show')->name('reviews.show'); //review post show
//admin login not worked yet
//Route::get('/custom_login', 'AuthController@login')->name('custom_login');
//Route::posts('posts-login', 'AuthController@postLogin')->name('login_confirm');
//Route::get('/registration', 'AuthController@registration')->name('register');
//Route::posts('posts-registration', 'AuthController@postRegistration')->name('reg_confirm');
//Route::get('dashboard', 'AuthController@dashboard');
//Route::get('logout', 'AuthController@logout')->name('logout');
