<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShareButtonsController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\PresentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

// 前台首頁
Route::get('/', 'FrontController@classIndex');
// 履歷表首頁
Route::get('/resume', 'FrontController@resumeIndex');
// 藝術家首頁
Route::get('/artist', 'FrontController@artistIndex');
// 处理AJAX验证请求
Route::post('/verifydata', 'PresentController@testAjax');
// 处理AJAX验证请求
Route::put('/verifydata2', 'PresentController@testAjax2');
// 处理AJAX验证请求
// 定義 AJAX 接收的 POST 路由
Route::post('/verifydata3', [PresentController::class, 'toggleStatus']);
// 3. 顯示結果列表頁
Route::get('/resume/list', [PresentController::class, 'list'])->name('resume.list');
// 自我介紹
Route::group(['prefix' => 'present'], function (){
	// 自我介紹前端顯示
	Route::get('/', 'PresentController@presentList');
	// 處理自我介紹技能評分
	Route::get('/getstar', 'PresentController@presentGetStar');
	// 新增履歷
	Route::get('/add', 'PresentController@resumeAddId');
	Route::post('/submit-user-data', 'PresentController@submitData');
	// 處理新增履歷
	Route::put('/adl', 'PresentController@resumeAddIdDeal');
	// 履歷清單管理
	Route::get('/manage', 'PresentController@resumeManageList');
	// 指定履歷
	Route::group(['prefix' => '{resume_id}'], function (){
		// 修改履歷
		Route::get('/edit', 'PresentController@resumeItemEdit');
		// 處理修改履歷
		Route::put('/resumeEditDeal', 'PresentController@resumeEditDeal');
		// 處理引用履歷
		Route::get('/chgResumesDis', 'PresentController@resumeChangeResumeDisplay');
		// 顯示單一履歷
		Route::get('/list', 'PresentController@resumeItemList');
		// 刪除課程
		Route::get('/del', 'PresentController@resumeItemDel');
		// 使用者管理課程刪除
		Route::get('/mdel', 'PresentController@resumeManageItemDel');
		Route::get('/export', 'PresentController@export');
			
		// 課程內容
		Route::get('/itm', 'ClassController@classItem');

	});
});

// 會員管理 
Route::group(['prefix' => 'user'], function (){
	// 會員列表
	Route::get('/', 'UserController@userList');
	// 使用者驗證
	Route::group(['prefix' => 'auth'], function (){
		// 註冊
		Route::get('/register', 'UserController@signUp'); 
		// 處理註冊
		Route::post('/register', 'UserController@signUpDeal');
		// 登入
		Route::get('/login', 'UserController@signIn');
		// 處理登入
		Route::post('/login', 'UserController@signInDeal');
		// // Facebook 登入
		// Route::get('/facebook-sign-in', 'UserController@facebookSignInProcess');
		// // Facebook 登入重新導向授權資料處理
		// Route::get('/facebook-sign-in-callback', 'UserController@facebookSignInCallbackProcess');
		// // Google 登入
		// Route::get('/google-sign-in', 'UserController@googleSignInProcess');
		// // Google 登入重新導向授權資料處理
		// Route::get('/google-sign-in-callback', 'UserController@googleSignInCallbackProcess');
		// // Github 登入
		// Route::get('/github-sign-in', 'UserController@githubSignInProcess');
		// // Github 登入重新導向授權資料處理
		// Route::get('/github-sign-in-callback', 'UserController@githubSignInCallbackProcess');
		

		// 指定課程
		Route::group(['prefix' => '{user_id}'], function (){
			// 修改帳號人員
			Route::get('/edit', 'UserController@memberUp');
			// 處理修改帳號
			Route::put('/', 'UserController@memberUpDeal');
			// 處理修改帳號
			Route::get('/del', 'UserController@memberItemDel');
		});
		// 登出
		Route::get('out', 'UserController@signOut');
	});
});

// 網站管理
Route::group(['prefix' => 'site'], function (){
	// 網站管理清單檢視
	Route::get('/manage', 'SiteController@siteManageList');
	// 更新目前網站顯示
	Route::get('/chgSiteDis', 'SiteController@siteChgViewDis');
	// 指定網站
	Route::group(['prefix' => '{site_id}'], function (){
		// 更新網站維護進行
		Route::get('/chgMainDis', 'SiteController@siteChgMainDis');
		// 更新網站說明
		Route::get('/chgMainDes', 'SiteController@siteChgMainDes');
	});
});

// 課程管理
Route::group(['prefix' => 'class'], function (){
	// 課程列表
	Route::get('/', 'ClassController@classList');
	// 新增課程
	Route::get('/add', 'ClassController@classAddId');
	// 處理新增課程
	Route::put('/adl', 'ClassController@classAddIdDeal');
	// 填報名表單
	Route::get('/join', 'ClassController@joinClass');
	// 課程與活動預約
	Route::get('/joins', 'ClassController@joinClassAdd');
	// 課程與活動預約處理
	Route::put('/joind', 'ClassController@joinClassDeal');
	// 課程管理清單檢視
	Route::get('/manage', 'ClassController@classManageList');
	// 課程匯出
	Route::get('/export', 'ClassController@exportAllClass');

	// 指定課程
	Route::group(['prefix' => '{course_id}'], function (){
		// 修改課程
		Route::get('/edit', 'ClassController@classItemEdit');
		// 報名名單
		Route::get('/list', 'ClassController@classItemList');
		// 處理修改課程
		Route::put('/', 'ClassController@classItemRenewDeal');
		// 刪除課程
		Route::get('/del', 'ClassController@classItemDel');
		// 使用者管理課程刪除
		Route::get('/mdel', 'ClassController@classManageItemDel');
		Route::get('/export', 'ClassController@export');
			
		// 課程內容
		Route::get('/itm', 'ClassController@classItem');

	});
});

// 新聞管理
Route::group(['prefix' => 'news'], function (){
	// 此項目已無提供服務
	Route::get('/noserve', 'NewsController@newsNoServe');
	// 輪播管理
	Route::get('/carouselManage', 'NewsController@newsCarouselManage');
	// 案例分享
	Route::get('/share', 'NewsController@newsShare');
	// 隨堂考
	Route::get('/faq', 'NewsController@newsFaq');
	// 新聞列表 
	Route::get('/', 'NewsController@newsList');
	// 新增新聞
	Route::get('/add', 'NewsController@newsAddId');
	// 新增輪播
	Route::get('/addcarousel', 'NewsController@newsAddCarousel');
	// 處理新增輪播
	Route::put('/addcarouseldeal', 'NewsController@newsAddCarouselDeal');
	// 新增類別
	Route::get('/addsort', 'NewsController@newsAddSort');
	// 處理新增類別
	Route::put('/addsortdeal', 'NewsController@newsAddSortDeal');
	// 新增麵包屑
	Route::get('/addbreadcrumbs', 'NewsController@newsAddBreadcrumbs');
	// 處理新增麵包屑
	Route::put('/addbreadcrumbsdeal', 'NewsController@newsAddBreadcrumbsDeal');
	// 新增選單
	Route::get('/addMenu', 'NewsController@newsAddMenu');
	// 處理新增選單
	Route::put('/addMenuDeal', 'NewsController@newsAddMenuDeal');
	// 處理新增新聞
	// Route::put('/adl', 'NewsController@newsAddIdDeal');
	// 填報名表單
	// Route::get('/join', 'NewsController@joinNews');
	// 課程與活動預約
	// Route::get('/joins', 'NewsController@joinNewsAdd');
	// 課程與活動預約處理
	// Route::put('/joind', 'NewsController@joinNewsDeal');
	// 新聞管理清單檢視
	Route::get('/manage', 'NewsController@newsManageList');
	// 類別管理清單檢視newsSortEdit
	Route::get('/managesort', 'NewsController@newsManageSortList');
	// 麵包屑管理清單檢視
	Route::get('/managebreadcrumbs', 'NewsController@newsManageBreadcrumbsList');
	// 清單管理清單檢視
	Route::get('/manageMenu', 'NewsController@newsManageMenuList');
	
	// 課程匯出
	// Route::get('/export', 'NewsController@exportAllClass');

	// 指定新聞
	Route::group(['prefix' => '{News_id}'], function (){
		// 修改新聞
		Route::get('/edit', 'NewsController@newsItemEdit');
		// 修改類別
		Route::get('/sortEdit', 'NewsController@newsSortEdit');
		// 處理修改類別
		Route::put('/sortEditDeal', 'NewsController@newsSortEditDeal');
		// 修改麵包屑
		Route::get('/breadcrumbEdit', 'NewsController@newsBreadcrumbEdit');
		// 處理修改麵包屑
		Route::put('/breadcrumbEditDeal', 'NewsController@newsBreadcrumbEditDeal');
		// 修改輪播圖片
		Route::get('/carouselEdit', 'NewsController@newsCarouselEdit');
		Route::put('/carouselEditDeal', 'NewsController@newsCarouselEditDeal');
		// 修改選單
		Route::get('/menuEdit', 'NewsController@newsMenuEdit');
		// 處理修改選單
		Route::put('/menuEditDeal', 'NewsController@newsMenuEditDeal');
		// 報名名單
		//Route::get('/list', 'NewsController@newsItemList');
		// 處理修改課程
		//Route::put('/', 'NewsController@newsItemRenewDeal');
		// 刪除課程
		//Route::get('/del', 'NewsController@newsItemDel');
		// 使用者管理課程刪除
		//Route::get('/mdel', 'NewsController@newsManageItemDel');
		Route::get('/export', 'NewsController@export');
		// 修改類別
		Route::get('/post', 'NewsController@newsIndexPageUp');	
		// 課程內容
		Route::get('/itm', 'NewsController@newsItem');
		// 課程內容
		Route::get('/faq', 'NewsController@newsFaqList');
		// 課程內容
		Route::get('/menu', 'NewsController@newsMenu');
		// 更新輪播檢視
		Route::get('/chgcarouseldis', 'NewsController@newsChangeCarouselDisplay');
		// 更新新聞檢視
		Route::get('/chgnewsdis', 'NewsController@newsChangeNewsDisplay');
		// 更新麵包屑檢視
		Route::get('/chgbreadcrumbdis', 'NewsController@newsChangebreadcrumbDisplay');
		// 更新類別檢視
		Route::get('/chgsortdis', 'NewsController@newsChangeSortDisplay');
		// 更新選單檢視
		Route::get('/chgmenudis', 'NewsController@newsChangeMenuDisplay');
		
	});
});

//新增新聞
Route::put('/add_data',[HomeController::class,'newsAdd']);
Route::get('/show_data',[HomeController::class,'show_data']);
//更新新聞
Route::put('/upd_data/{id}',[HomeController::class,'newsUpd']);
// Route::get('editor', 'EditorController@index');
// Route::post('store', 'EditorController@store');
// Route::post('editor/image_upload', 'EditorController@upload')->name('upload');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/postq',[ShareButtonsController::class,'newsShare']);
Route::get('/chat',[PusherController::class,'chatIndex']);
Route::post('/broadcast',[PusherController::class,'broadcast']);
Route::post('/receive',[PusherController::class,'receive']);