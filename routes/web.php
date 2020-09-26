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
 Route::get('/apitoken', 'Auth/ApiTokenController@update')->name('newapitoken');
Route::get('/', 'firstpageController@index')->name('firstpage');// very first page
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');//home
 //profile section
Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');//profile showing
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');//profile edit
Route::post('/edit', 'ProfileController@update')->name('profile.update');//profile edit process
 //posts section
Route::get('/p/create', 'PostsController@create')->name('posts.create');//posts
Route::post('/p', 'PostsController@store')->name('posts.store');//posts storing process
Route::get('/p/{post}', 'PostsController@showdata')->name('posts.show'); //posts show
Route::get('/p/{post}/delete', 'PostsController@post_delete')->name('posts.delete'); //post delete
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
 Route::get('p/{posts}/review/by{user}/{review}','ReviewController@show')->name('reviews.show'); //show single reviews

 Route::post('{posts}/{reviews}/commentupdate', 'ReviewController@comment')->name('comment.update'); //admin
 Route::get('r/{review}/edit', 'ReviewController@reviews_edit')->name('reviews.editget');
 Route::post('r/{review}/p', 'ReviewController@reviews_editpost')->name('reviews.editpost');
 //admin
 Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/a', 'AdminController@generate_ac')->name('admin_first_time');
Route::get('/admin/stat', 'AdminController@stats')->name('admin.stat');
Route::get('/admin_editprofile/{id}', 'AdminController@index2')->name('admin_editprofile');
Route::post('/{admin}/aep', 'AdminController@profile_update')->name('admin.profile_update');
Route::get('/admin/paper_req', 'AdminController@paper_request')->name('check_paper_req');
Route::get('/admin/edit_req', 'AdminController@edit_request')->name('check_edit_req');
Route::post('/er/app/{reviews}', 'AdminController@editreq_approve')->name('editreq.approve');
Route::post('/er/dec/{req}', 'AdminController@editreq_decline')->name('editreq.decline');
//message
 Route::get('/message/{other}', 'MessageController@index')->name('message.person');
 Route::post('/m/{other}', 'MessageController@update')->name('message.update');

 Route::get('messages', 'MessageController@fetchMessages');
 Route::post('messages', 'MessageController@sendMessage');
 //discussion
 Route::get('/discussion', 'DiscussionController@index')->name('discussion');
 Route::post('/dis/', 'DiscussionController@update')->name('qus.update');
 Route::get('/ses', 'UserController@show');
