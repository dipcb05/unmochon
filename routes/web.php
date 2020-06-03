 <?php

 use App\Mail\WelcomeMail;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Route;

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
Route::get('/p/{posts}/delete', 'PostsController@post_delete')->name('posts.delete'); //post delete
Route::get('/preq', 'HomeController@paper_req')->name('paper.req');
Route::post('/{user}/adminsend', 'HomeController@admin_task')->name('req.save');
 //query section
 Route::post('/search', 'firstpageController@search')->name('front.search');
Route::get('/query/{key}', 'firstpageController@see_paper')->name('query.show');
Route::post('/homesearch', 'HomeController@search')->name('home.search');
//review & comment section
Route::get('p/{posts}/review/', 'ReviewController@index')->name('posts.reviews'); //review page
Route::get('p/{posts}/review/reviewform', 'ReviewController@form')->name('reviews.edit'); //review writing
Route::post('p/{posts}/r', 'ReviewController@update')->name('reviews.update'); //review posts
Route::get('p/{posts}/r/{reviews}/delete', 'ReviewController@review_delete')->name('reviews.delete');
 Route::get('p/{posts}/review/by{user}/{review}','ReviewController@show')->name('reviews.show'); //show single review of post
 Route::get('p/{posts}/review/by{user}/{review}/newcomment', 'ReviewController@postcomment')->name('comment.create');
 Route::post('{posts}/{reviews}/commentupdate', 'ReviewController@comment')->name('comment.update');
 //admin
Route::get('/admin', 'AdminController@index')->name('admin.auth');
Route::post('/login_confirm', 'AdminController@login')->name('login.confirm');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard.show');
Route::get('/logout', 'AdminController@logout')->name('admin.logout');

