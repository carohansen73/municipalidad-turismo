<?php
use App\Http\Controllers\ServiceProviderController;

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

Route::get('/', function () {
    return view('front.home');
});
Route::get('/servicios', 'ServiceFrontEndController@index')->name('servicios');
Route::get('/ver-servicios/{id}', 'ServiceFrontEndController@showServiceProviders')->name('servicios.ver');
Route::get('/ver-proveedor/{id}', 'ServiceFrontEndController@showSingleProvider')->name('proveedor.ver');

/*CMS*/

Route::get('/noticias', 'PostController@news')->name('news');

Route::get('categoria/{category_slug}/noticia/{new_slug}', 'PostController@singleNew')->name('single.new');

Route::get('noticia/buscar', 'PostController@searchNew')->name('search.new');

Route::get('categoria/{category_slug}', 'PostCategoryController@allNews')->name('category.news');

Route::get('tag/{tag_slug}', 'PostTagController@allNews')->name('tag.news');

Route::get('/eventos', 'EventController@events')->name('events');

Route::get('evento/buscar', 'EventController@searchEvent')->name('search.event');

Route::get('evento/{event_slug}', 'EventController@singleEvent')->name('single.event');

Route::get('lugares/{place_slug}', 'PlaceController@singlePlace')->name('single.place');

Auth::routes();
Route::get('register', '\App\Http\Controllers\Auth\RegisterController@redirectLogin')->name('register');
Route::get('password/reset', '\App\Http\Controllers\Auth\RegisterController@redirectLogin')->name('register');

Route::group(['middleware' => 'auth'], function () {


    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    // Perfil
    Route::get('/perfil', 'UserController@showProfile')->name('profile');
    Route::put('/perfil/{user_id}', 'UserController@updateProfile')->name('profile.update');
    // Banners
    Route::resource('banners', 'BannerController')->except('show');
    // Lugares
    Route::resource('lugar', 'PlaceController')->except('show');
    Route::delete('lugar/galeria/imagen/{id}', 'PlaceGaleryImageController@destroy')->name('place.galery.image.destroy');
    // Eventos
    Route::get('/acontecimientos/papelera', 'EventController@trash')->name('events.trash');
    Route::delete('/acontecimientos/papelera/{id}', 'EventController@trashDelete')->name('events.trash.delete');
    Route::get('/acontecimientos/papelera/restaurar/{id}', 'EventController@restore')->name('events.trash.restore');
    Route::resource('acontecimientos', 'EventController')->except('show');
    // Equipos
    Route::resource('equipo', 'TeamController')->except('show');



    Route::get('equipo/redes/{team_id}', 'TeamController@socialNetworkList')->name('social.network.list');
    Route::get('equipo/redes/{team_id}/crear', 'TeamController@socialNetworkCreate')->name('social.network.create');
    Route::post('equipo/redes/store', 'TeamController@socialNetworkStore')->name('social.network.store');
    Route::get('equipo/redes/editar/{social_network_id}', 'TeamController@socialNetworkEdit')->name('social.network.edit');
    Route::put('equipo/redes/editar/{social_network_id}', 'TeamController@socialNetworkUpdate')->name('social.network.update');
    Route::delete('equipo/redes/{social_network_id}', 'TeamController@socialNetworkDestroy')->name('social.network.destroy');
    // Posts
    Route::get('/posts/papelera', 'PostController@trash')->name('posts.trash');
    Route::delete('/posts/papelera/{id}', 'PostController@trashDelete')->name('posts.trash.delete');
    Route::get('/posts/papelera/restaurar/{id}', 'PostController@restore')->name('posts.trash.restore');
    Route::resource('posts', 'PostController')->except('show');

    Route::delete('post/galeria/imagen/{id}', 'PostGaleryImageController@destroy')->name('galeria.imagen.destroy');

    //Servicios
    Route::resource('service-providers', 'serviceProviderController')->except('show');
    Route::get('/amenities/{service_id}', [serviceProviderController::class, 'getAmenitiesByService']);

    // Parametros
    Route::group(['prefix' => 'parametros'], function () {
        Route::group(['middleware' => 'can:view-all,App\Models\SocialNetwork'], function () {
            // Redes sociales
            Route::resource('redes', 'SocialNetworkController')->except('show');
        });
        // Post
        Route::group(['prefix' => 'posts'], function () {
            // Categorías
            Route::resource('categorias', 'PostCategoryController', ['as' => 'posts'])->except('show');
            // Tags
            Route::resource('tags', 'PostTagController', ['as' => 'posts'])->except('show');
        });
    });

    Route::group(['prefix' => 'configuraciones'], function () {
        Route::group(['prefix' => 'sitio'], function () {
            Route::resource('redes', 'SiteSocialNetworkController', ['as' => 'sitio'])->except('show');
        });

        Route::group(['middleware' => 'can:view-all,App\Models\User'], function () {
            Route::resource('usuarios', 'UserController');
        });
    });

    // Configuraciones del sitio
    Route::get('configuraciones-del-sitio', 'SiteConfigurationController@edit')->name('siteConfigurations.edit');
    Route::patch('configuraciones-del-sitio/update/{id}', 'SiteConfigurationController@update')->name('siteConfigurations.update');
});

// Route::resource('postGaleryImages', 'PostGaleryImageController');
// Route::resource('siteConfigurations', 'SiteConfigurationController');
