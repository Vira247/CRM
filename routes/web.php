<?php



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



Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getgoogledata', 'CronJobController@index')->name('home');
Route::get('/getdata-sessions-pageviews-data','GoogleAnalyticsController@toDaySessionsPageviewsData');
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('master', 'MasterController');
    Route::get('/master/delete/{id}', 'MasterController@delete');
    Route::resource('vendor', 'VendorController');
    Route::get('importProductList', 'VendorController@importProductList');
    Route::get('/vendor/delete/{id}', 'VendorController@delete');
    Route::get('vendor-report-gorup-by-month-year', 'VendorController@reportByMonthYearGroupBy');
    Route::get('vender-order-by-month/{id}/{year}/{month}', 'VendorController@reportByMonthYear');
    Route::resource('product', 'ProductController');
    Route::get('/product/delete/{id}', 'ProductController@delete');
    Route::get('/product/list/{vendor}/{producttyp}', 'ProductController@getProductListByVendorType');
    Route::get('/product/list-by-vendor/{vendor}', 'ProductController@getProductListByVendor');
    Route::get('product-order-by-vendor-date', 'ProductController@productOrderByVendorDate');
    Route::get('sample-vs-product-report', 'ReportController@sampleVSProduct');
    Route::get('report-product-list-by-date', 'ReportController@reportProductListByDate');
    Route::get('sample-vs-product', 'ReportController@sampleVSProductReport');
    Route::get('report/sample-vs-product', 'ReportController@sampleVSProductReportDetail');
    Route::get('report/sample-vs-product-summury', 'ReportController@sampleVSProductReportSummury');
    Route::get('importSample', 'ProductController@importSample');
    Route::resource('order', 'OrderController');
    Route::get('/order/delete/{id}', 'OrderController@delete');
    Route::get('getAll', 'OrderController@getAll');
    Route::get('profile', 'ProfileController@profile');
    Route::post('/profile/change-password', 'ProfileController@changePassword');
    Route::post('/upload-profile-pic', 'ProfileController@uploadProfile');
    Route::resource('inquiry', 'InquiryController');
    Route::post('add/inquiry-data/{id}', 'InquiryController@addFollowUp');
    Route::get('inquiry/chnage-status/{id}/{status}', 'InquiryController@changeStatus');
    Route::get('follow-up-list', 'InquiryController@followUpList');
    Route::get('follow-calendar', 'InquiryController@followCalendar');
    Route::get('getfollowuplist', 'InquiryController@followDateList');
    Route::get('get-followUp-notification-count', 'InquiryController@getFollowUpNotificationCount');
    Route::get('/google-home', 'HomeController@googleindex')->name('home');
    Route::get('/google-page-view-list', 'HomeController@googlePageList')->name('page list');
    
    Route::get('/getdata-sessions-pageviews','GoogleAnalyticsController@toDaySessionsPageviews');
    Route::get('/getdata-sessions-pageviews-path','GoogleAnalyticsController@sessionsPageviewsPath');
    Route::get('/getdata-mobile-trafic','GoogleAnalyticsController@toDayMobileTrafic');
    //Route::get('/getdata-revenue-generating-campaigns','GoogleAnalyticsController@toDayRevenueGeneratingCampaigns');
    Route::get('/getdata-users','GoogleAnalyticsController@toDayUsers');
    Route::get('/getdata-sessions-by-country','GoogleAnalyticsController@sessionsByCountry');
    //Route::get('/getdata-browser-and-operating-system','GoogleAnalyticsController@browserAndOperatingSystem');
    //Route::get('/getdata-time-on-site','GoogleAnalyticsController@timeOnSite');
    //Route::get('/getdata-traffic-sources','GoogleAnalyticsController@trafficSources');
    //Route::get('/getdata-all-traffic-sources-goals','GoogleAnalyticsController@allTrafficSourcesGoals');
    //Route::get('/getdata-all-traffic-sources-e-commerce','GoogleAnalyticsController@allTrafficSourcesECommerce');
    //Route::get('/getdata-referring-sites','GoogleAnalyticsController@referringSites');
    //Route::get('/getdata-search-engines','GoogleAnalyticsController@searchEngines');
    //Route::get('/getdata-search-engines-organic-search','GoogleAnalyticsController@SearchEnginesOrganicSearch');
    //Route::get('/getdata-search-engines-paid-search','GoogleAnalyticsController@SearchEnginesPaidSearch');
    Route::get('/getdata-keywords','GoogleAnalyticsController@keyWords');
    //Route::get('/getdata-top-content','GoogleAnalyticsController@topContent');
    Route::get('/getdata-top-landing-pages','GoogleAnalyticsController@topLandingPages');
    Route::get('/getdata-top-exit-pages','GoogleAnalyticsController@topExitPages');
    //Route::get('/getdata-site-search-search-terms','GoogleAnalyticsController@siteSearchSearchTerms');
    Route::get('/getdata-session-by-time','GoogleAnalyticsController@toDayTimeSessionsPageviews');
});
