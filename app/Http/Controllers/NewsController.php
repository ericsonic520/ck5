<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\carousel;
use App\Models\pluss;
use App\Models\user;
use App\Models\post;
use App\Models\site;
use App\Models\sort;
use App\Models\breadcrumb;
use App\Models\menu;
use App\Exports\CourseExport;
use App\Exports\CourseExportAll;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use DOMDocument;
use DB;
use Image;
use Validator;
use Auth;
use ECPay_AllInOne;
use ECPay_PaymentMethod;

class NewsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // } 
    
    // 首頁
    public function classIndex()
    {
        // 重新導向至課程頁
        return redirect('login');
    }

    // 新增新聞
    public function newsAddId(){
        $sort = sort::OrderBy('sort_id', 'asc')
                ->where('sort_display','=','1')
                ->get();
                
        $binding = [
            'title' => '新增新聞',
            'back' => '<-',
            'sort' => $sort,
        ];
        return view('news.newsAdd', $binding);
    }

    // 處理新增新聞
    public function newsAddIdDeal(){
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [
            
            // 新聞標題
            'title' => [
                'required',
            ],
            // 新聞類別
            'sort' => [
                'required',
            ],
            // 新聞內容
            'description' => [
                'required',
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/news/add')      
                ->withErrors($validator)
                ->withInput();
        }

        // if (isset($input['pic'])) {
        //     // 有上傳圖片
        //     $pic = $input['pic'];
        //     // 檔案副檔名
        //     $file_extension = $pic->getClientOriginalExtension();
        //     // 產生自訂隨機檔案名稱
        //     $file_name = uniqid() . '.' . $file_extension;
        //     // 檔案相對路徑
        //     $file_relative_path = 'images/news/' . $file_name;
        //     // 檔案存放目錄為對外公開public目錄下的相對位置
        //     $file_path = public_path($file_relative_path);
        //     // 裁切圖片
        //     $image = Image::make($pic)->fit(250,100)->save($file_path);
        //     // 設定圖片檔案相對路徑
        //     $input['pic'] = $file_relative_path;
        // } 



        // dd(json_encode($input['content']));
        // dd($input['content']);
        // exit;
	    // $data = array();
        // $json = "";
        // foreach($input as $key=>$value){
        //     // $obj=$value['pic'];
        //     // $data[] = $obj;
        //     $data = json_encode($input['content']);
        //     dd($data);
        // }
        // $json->data=$data;
        // $json->msg = "true";
        // exit;
        // 課程資料更新
        $News = news::create($input);

        // 重新導向到課程編輯頁
        return redirect('/news/manage/');
    }

    //新增類別
    public function newsAddSort (){
                
        $binding = [
            'title' => '新增類別',
        ];
        return view('news.newsAddSort', $binding);
    }

    // 處理新增新聞類別
    public function newsAddSortDeal(){

        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 新聞類別名稱
            'sort_name' => [
                'required',
                'max:80'
            ],
            // 新聞英文類別名稱
            'sort_name_en' => [
                'required',
                'max:80'
            ],
            // 新聞內容
            'sort_display' => [
                'required',
                'in:1'
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
             // 資料驗證錯誤
             return redirect('/news/addsort')      
                 ->withErrors($validator)
                 ->withInput();
         }

        sort::create([
            'sort_name' => request()->sort_name,
            'sort_name_en' => request()->sort_name_en,
            'sort_display' => request()->sort_display,
        ]);
        // 重新導向到新聞類別編輯頁
        return redirect('/news/managesort/');
    }

    // 類別更新
    public function newsSortEdit($sort_id){
        $SortPaginate = sort::where('sort_id', '=',$sort_id)->get();
        $Sort_id = session()->put('sort_id', $sort_id);

        $binding = [
            'title' => '類別更新',
            'sort_id' => $sort_id,
            'SortPaginate' => $SortPaginate,
        ];
        return view('news.newsSortEdit', $binding);
    }

    // 類別更新處理
    public function newsSortEditDeal(Request $request){
        $Sort_id = session()->get('sort_id');
        
        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 類別名稱
            'sort_name' => [
                'required',
                'max:80'
            ],
            // 類別英文名稱
            'sort_name_en' => [
                'required',
                'max:80'
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
             // 資料驗證錯誤
             return redirect('/news/'.$Sort_id.'/sortEdit')      
                 ->withErrors($validator)
                 ->withInput();
         }

        $sort = sort::find($Sort_id);
        $sort->update([
            'sort_name' => $request->sort_name,
            'sort_name_en' => $request->sort_name_en,
        ]);
        return redirect('/news/'.$Sort_id.'/sortEdit');
    }

    // 管理類別
    public function newsManageSortList (){

            $News_id=session()->get('news_id');
            
            // 每頁資料量
            $row_per_page = 10;
            // 撈取類別分頁資料
            $SortPaginate = sort::OrderBy('sort_id', 'asc')
                ->paginate($row_per_page);

                $binging = [
                    'title' => '管理類別',
                    'SortPaginate' => $SortPaginate,
                ];
              
            return view('news.newsSortManage', $binging);

    }

     //新增麵包屑
     public function newsAddBreadcrumbs (){
                
        $binding = [
            'title' => '新增麵包屑',
        ];
        return view('news.newsAddBreadcrumbs', $binding);
    }

    // 處理新增麵包屑
    public function newsAddBreadcrumbsDeal(){

        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 麵包屑名稱
            'breadcrumb_name' => [
                'required',
                'max:80'
            ],
            // 麵包屑英文名稱
            'breadcrumb_name_en' => [
                'required',
                'max:80'
            ],
            // 麵包屑api
            'breadcrumb_api' => [
                'required',
                'max:80'
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
             // 資料驗證錯誤
             return redirect('/news/addbreadcrumbs')      
                 ->withErrors($validator)
                 ->withInput();
         }

        breadcrumb::create([
            'breadcrumb_name' => request()->breadcrumb_name,
            'breadcrumb_name_en' => request()->breadcrumb_name_en,
            'breadcrumb_api' => request()->breadcrumb_api,
            'breadcrumb_display' => 1,
        ]);
        // 重新導向到麵包屑管理頁
        return redirect('/news/managebreadcrumbs');
    }

    // 檢視麵包屑
    public function newsManageBreadcrumbsList (){

        $News_id=session()->get('news_id');
        
        // 每頁資料量
        $row_per_page = 10;
        // 撈取課程分頁資料
        $BreadcrumbPaginate = breadcrumb::OrderBy('breadcrumb_id', 'asc')
            ->paginate($row_per_page);
        //    dd($BreadcrumbPaginate); 
        // foreach ($SortPaginate as $key=>$Sort) {
        //     if (!is_null($Post->pic)) {
        //         // 設定課程照片網址
        //         $Post->pic = url($Post->pic);
        //     }  
        //     $aa=json_decode($Post);
        //     // dd($aa->content);
        // }
        $binging = [
            'title' => '管理麵包屑',
            'BreadcrumbPaginate' => $BreadcrumbPaginate,
        ];
          
        return view('news.newsBreadcrumbManage', $binging);
        
    }

    //更新麵包屑
    public function newsBreadcrumbEdit($breadcrumb_id) {
        $BreadcrumbPaginate = breadcrumb::where('breadcrumb_id', '=',$breadcrumb_id)->get();
        $Breadcrumb_id = session()->put('breadcrumb_id', $breadcrumb_id);

        $binding = [
            'title' => '麵包屑更新',
            'breadcrumb_id' => $breadcrumb_id,
            'BreadcrumbPaginate' => $BreadcrumbPaginate,
        ];
        return view('news.newsBreadcrumbEdit', $binding);
    }

    //麵包屑更新處理
    public function newsBreadcrumbEditDeal(Request $request,$breadcrumb_id) {
        $breadcrumb_id = session()->get('breadcrumb_id');
            // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 麵包屑名稱
            'breadcrumb_name' => [
                'required',
                'max:80'
            ],
            // 麵包屑英文名稱
            'breadcrumb_name_en' => [
                'required',
                'max:80'
            ],
            // 麵包屑api
            'breadcrumb_api' => [
                'required',
                'max:80'
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
             // 資料驗證錯誤
             return redirect('/news/'.$breadcrumb_id.'/breadcrumbEdit')      
                 ->withErrors($validator)
                 ->withInput();
         }

        $breadcrumb = breadcrumb::find($breadcrumb_id);
        $breadcrumb->update([
            'breadcrumb_name' => $request->breadcrumb_name,
            'breadcrumb_name_en' => $request->breadcrumb_name_en,
            'breadcrumb_api' => $request->breadcrumb_api,
        ]);
        return redirect('/news/'.$breadcrumb_id.'/breadcrumbEdit');
    }

    //新增選單
    public function newsAddMenu (){
                
        $binding = [
            'title' => '新增選單',
        ];
        return view('news.newsAddMenu', $binding);
    }

    //處理新增選單
    public function newsAddMenuDeal(Request $request)
    {   
        $description = $request->menu_description;
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 選單API
            'menu_api' => [
                'required',
                'max:80',
            ],
            // 選單名稱
            'menu_name' => [
                'required',
                'max:80',
            ],
            // 新聞說明
            'menu_caption' => [
                'required',
                'max:80',
            ],
            // 新聞內文
            'menu_description' => [
                'required',
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/news/addMenu')      
                ->withErrors($validator)
                ->withInput();
        }
        $dom = new DOMDocument();
        
        $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'));
        //$dom->loadHTML($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        

        $images = $dom->getElementsByTagName('img');
        
        foreach($images as $key => $img){
        $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);          
        $image_name=  '/upload/'.time().$key.'.png';
        file_put_contents(public_path().$image_name,$data);
        
        $img->removeAttribute('src');     
        $img->setAttribute('src', $image_name);     
        }
        $description = $dom->saveHTML(); 
        menu::create([
            'menu_api' => request()->menu_api,
            'menu_name' => request()->menu_name,
            'menu_caption' => request()->menu_caption,
            'menu_description' => $description,
            'menu_site' => 1,
            'menu_display' => request()->menu_display,
        ]);
        // $post = new Post;
        // $post->title = $title;
        // $post->sort = $sort;
        // $post->description = $description;  
        // $post->save();

        // 每頁資料量
        //$row_per_page = 8;
        // 撈取商品分頁資料
        //$PostPaginate = Post::OrderBy('id', 'asc')
        //    ->paginate($row_per_page);


        // // 設定課程圖片網址
        // foreach ($PostPaginate as &$Post) {
        //     if (!is_null($Post->title)) {
        //         // 設定課程照片網址
        //         $Post->title = url($Post->title);
        //     }
            
        // } 
    
        // $binding = [
        //     'title' => '新聞列表',
        //     'PostPaginate' => $PostPaginate,
        // ];
        // return redirect()->back();
        // return view('news.post_data', $binding);
        // return view('News.newsList', $binding);
        // 重新導向到課程編輯頁
        return redirect('/news/manageMenu');
    } //   $dom->loadHTML($description,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // 檢視選單
    public function newsManageMenuList (){

        $Menu_id=session()->get('menu_id');
        
        // 每頁資料量
        $row_per_page = 10;
        // 撈取課程分頁資料
        $MenuPaginate = menu::OrderBy('menu_id', 'asc')
            ->paginate($row_per_page);

            $binging = [
                'title' => '管理選單',
                'MenuPaginate' => $MenuPaginate,
            ];
        
        return view('news.newsMenuManage', $binging);

    }

    //更新選單
    public function newsMenuEdit($menu_id) {
        $MenuPaginate = menu::where('menu_id', '=',$menu_id)->get();
        $Menu_id = session()->put('menu_id', $menu_id);

        $binding = [
            'title' => '選單更新',
            'menu_id' => $menu_id,
            'MenuPaginate' => $MenuPaginate,
        ];
        return view('news.newsMenuEdit', $binding);
    }

    //選單更新處理
    public function newsMenuEditDeal(Request $request,$id)
    {  
        $menu_description = $request->menu_description;
        $menu = menu::find($id);
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 選單api
            'menu_api' => [
                'required',
                'max:80',
            ],
            // 選單名稱
            'menu_name' => [
                'required',
                'max:80'
            ],
            // 選單標題
            'menu_caption' => [
                'required',
                'max:80'
            ],
            // 選單內容
            'menu_description' => [
                'required',
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/news/'.$id.'/menuEdit')      
                ->withErrors($validator)
                ->withInput();
        }

        //$Post = DB::table('posts')->where("id","=",$request->id)->get();
       
        
        $menu_api = $request->menu_api;
        $menu_name = $request->menu_name;
        $menu_caption = $request->menu_caption;
        //dd($description);
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($menu_description, 'HTML-ENTITIES', 'UTF-8'));
       
        $images = $dom->getElementsByTagName('img');
       
        foreach($images as $key => $img){
            // Check if the image is a new one
            if(strpos($img->getAttribute('src'),'data:image/') ===0){
                $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);          
                $image_name=  '/upload/'.time().$key.'.png';
                file_put_contents(public_path().$image_name,$data);

                $img->removeAttribute('src');          
                $img->setAttribute('src', $image_name);
            }
           
            
        }    
        $menu_description = $dom->saveHTML();
    
        // $post = new Post;       
        // $post->title = $title;
        // $post->sort = $sort;
        // $post->description = $description;      
        // $post->update();
             
        $menu->update([
            'menu_api' => $menu_api,
            'menu_name' => $menu_name,
            'menu_caption' => $menu_caption,
            'menu_description' => $menu_description
        ]);
        // return redirect()->back();
        // return view('news.post_data', $binding);
        // return view('News.newsList', $binding);
        return redirect('news/'.$id.'/menuEdit');
    }

    // 前台新聞表單頁面內容
    public function newsMenu($menu_id)
    {
        $menu = menu::all();
        // $menu = DB::table('menus')->get();
        $Menus = DB::table('menus')
                ->where('menus.menu_id','=',$menu_id)
                // ->join('breadcrumbs','breadcrumbs.breadcrumb_id','=','posts.post_breadcrumb')
                // ->join('sorts','sorts.sort_id','=','posts.post_sort')
                ->leftjoin('sites','sites.site_id','=','menus.menu_site')
                ->get();
        $breadcrumbs = DB::table('breadcrumbs')->get();
        // $menus = DB::table('menus')->get();
        
        
        session()->put('menu_id', $menu_id);
        $user_id = session()->get('user_id');
        
        $data = [
            'id' => 1,
            'title' => 'The first title',
            'description' => 'This tutorial is about social share buttons in laravel...',
            // 'image' => 'cat.JPG',
        ];

        $shareButtons = \Share::page('https://www.ericsonic520.com',
    'here is the text',
        )
        ->facebook()
        ->pinterest()
        ->Reddit()
        ->twitter();

        // dd($Menus[0]->menu_id);

        $sitePaginate = DB::table('sites')
                        ->where('site_id','=','1')
                        ->get();

        $binging = [
            // 'sort_name' => $Posts[0]->sort_name,
            // 'sort_name_en' => $Posts[0]->sort_name_en,
            'menu_name' => $Menus[0]->menu_name,
            'menu_caption' => $Menus[0]->menu_caption,
            'menu_description' => $Menus[0]->menu_description,
            'site_title' => $Menus[0]->site_title,
            'site_description' => $Menus[0]->site_description,
            'site_name' => $Menus[0]->site_name,
            'site_lineid' => $Menus[0]->site_lineid,
            'site_wechartid' => $Menus[0]->site_wechartid,
            'site_cellphone' => $Menus[0]->site_cellphone,
            'site_address' => $Menus[0]->site_address,
            'site_name_en' => $Menus[0]->site_name_en,
            'menu_post_time' => $menu[0]->created_at,
            // 'description' => $Posts[0]->post_description,
            'menus' => $menu,
            // 'id' => $post_id,
            'breadcrumbs' => $breadcrumbs,
            'menu' => $Menus,
            'site' => $sitePaginate,
            'slide_no' => 5,
        ];
    
        
        if($Menus[0]->site_maintain=='0'){
            return view('front.showPostMenu', $binging, compact('data', 'shareButtons'));
        }else{
            return view('site.managelist', $binging);
        }   
    }

    // 更新編輯新聞頁面
    public function newsItemEdit($news_id)
    {
        //$News = post::findOrFail($news_id);
        $News = DB::table('posts')
                ->where('posts.post_id','=',$news_id)
                ->join('sorts','sorts.sort_id','=','posts.post_sort')
                ->leftjoin('sites','sites.site_id','=','posts.post_site')
                ->get();
        $Sorts = DB::table('sorts')
                ->where('sort_display','=','1')
                ->get();
                //dd(base64_encode($News[0]->post_description));
        // if (!is_null($News->pic)) {
        //     $News->pic = url($News->pic);
        // }
    
        $binding = [
            'title' => '編輯新聞',
            'News' => $News,
            'Sorts' => $Sorts,
            'news_id' => $news_id,
        ];

        return view('news.newsEdit', $binding);
    }

    public function classItemList($course_id)
    {
        $Course = course::findOrFail($course_id);
        $user_id = Auth::user()->id;
        $User = user::findOrFail($user_id);
        $row_per_page = 10;
        $PlusPaginate = pluss::where('user_id', $User->id)
                            ->where('class_id', $Course->id)
                            ->join('class', 'pluss.class_id', '=', 'class.id')
                            ->paginate($row_per_page);
        
        if(Auth::user()->type=='G'){
            $binging = [
                'title' => '我的課程',
                'PlusPaginate' => $PlusPaginate,
            ];
        }else{
            $binging = [
                'title' => '管理課程',
                'PlusPaginate' => $PlusPaginate,
            ];
        }

        return view('class.classItemList', $binging);
    }

    // 新聞資料更新處理
    public function newsItemRenewDeal($news_id){
        // 撈取新聞資料
        $News = Post::findOrFail($news_id);
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [
            // 新聞標題
            'title' => [
                'required',
                'max:255',
            ],
            // 新聞分類
            'sort' => [
                'required',
            ],
            // 新聞分類
            'description' => [
                'required',
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/news/' . $News->id . '/edit')      
                ->withErrors($validator)
                ->withInput();
        }

        // 新聞資料更新
        $News->update($input);

        // 重新導向到課程編輯頁
        return redirect('/news/' . $News->id . '/edit');
    }

    // 課程管理清單檢視
    public function newsManageList()
    {
        $News_id=session()->get('news_id');
        
        // 每頁資料量
        $row_per_page = 10;
        // 撈取課程分頁資料
        $PostPaginate = Post::OrderBy('post_id', 'asc')
            ->paginate($row_per_page);
        //    dd($NewsPaginate); 
        foreach ($PostPaginate as $key=>$Post) {
            if (!is_null($Post->pic)) {
                // 設定課程照片網址
                $Post->pic = url($Post->pic);
            }  
            $aa=json_decode($Post);
            // dd($aa->content);
        }


        if(Auth::user()->type=='G'){
            $binging = [
                'title' => '我的新聞',
                'PostPaginate' => $PostPaginate,
                'aa' => $aa,
            ];
        }else{
            $binging = [
                'title' => '管理新聞',
                'PostPaginate' => $PostPaginate,
                'aa' => $aa,
            ];
        }   
        return view('news.newsManage', $binging);
    }

    public function classManageItemDel($course_id)
    {   
        $pluss = pluss::where('class_id',$course_id)->first();
        // $pluss2=DB::table('pluss')->where('class_id','=',$course_id)->get();
        // dd($pluss);

        if (!empty($pluss)) {
            $pluss->delete();
            DB::table('class')->where('id', '=' ,$pluss->class_id)->increment('quota', 1);
            return redirect('/class/' . $pluss->class_id . '/list');
        }

        return redirect('/class/manage');
    }

    // 新聞清單檢視
    public function newsList()
    {  
        // 每頁資料量
        $row_per_page = 10;
        $PostPaginate = DB::table('posts')
                        ->OrderBy('post_id', 'asc')
                        ->join('sorts','sorts.sort_id','=','posts.post_sort')
                        ->leftjoin('sites','sites.site_id','=','posts.post_site')
                        ->paginate($row_per_page); 
        // session()->put('post_display', $PostPaginate[0]->post_display);
        $binding = [
            'title' => '新聞列表',
            'PostPaginate' => $PostPaginate,
        ];

        return view('news.newsList', $binding);
    }

    public function newsItemDel($News_id)
    {
        $post = Post::find($News_id);
        
        $dom = new DOMDocument();
        //$dom->loadHTML($post->description,9);
        $dom->loadHTML(mb_convert_encoding($post->description, 'HTML-ENTITIES', 'UTF-8'));
        $images = $dom->getElementsByTagName('img');
        
        foreach($images as $key => $img) {
           
            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');
         
            if (File::exists($path)){
                File::delete($path);
            }
        }

        $post->delete();
        return redirect()->back();
    }

    // 前台新聞內容
     public function newsItem($post_id)
    {
        
        $post = post::find($post_id);
        $Posts = DB::table('posts')
                ->where('posts.post_id','=',$post_id)
               // ->join('breadcrumbs','breadcrumbs.breadcrumb_id','=','posts.post_breadcrumb')
                ->join('sorts','sorts.sort_id','=','posts.post_sort')
                ->leftjoin('sites','sites.site_id','=','posts.post_site')
                ->get();
        $breadcrumbs = DB::table('breadcrumbs')
                        ->where('breadcrumbs.breadcrumb_display','=','1')
                        ->get();
        $menus = DB::table('menus')->get();
        // dd($Posts[0]->post_site);

        if($Posts[0]->post_site=='0'){
            return redirect('/news/noserve');
        }
        // session()->put('post_id', $post_id);
        // $user_id = session()->get('user_id');

        // dd($post_id);

        $SitePaginate = DB::table('sites')
                        ->where('site_id','=','1')
                        ->get();
        
        $site_blade = DB::table('sites')
                        // ->select('site_blade')
                        ->where('site_display' , '=' ,'1')
                        ->get();

        $row_per_page = 5;

        // 撈取新聞分頁資料
        $PostPaginate = DB::table('posts')
            ->where('posts.post_sort','=','3')
            ->join('sorts','sorts.sort_id','=','posts.post_sort')
            ->leftjoin('sites','sites.site_id','=','posts.post_site')
            ->where('post_display','=','1')
            ->OrderBy('post_id', 'asc')
            ->paginate($row_per_page);

        $binging = [
            'sort_name' => $Posts[0]->sort_name,
            'sort_name_en' => $Posts[0]->sort_name_en,
            'slide_no' => $Posts[0]->post_sort,
            'title' => $Posts[0]->post_title,
            'site_title' => $Posts[0]->site_title,
            'site_description' => $Posts[0]->site_description,
            'site_name' => $Posts[0]->site_name,
            'site_lineid' => $Posts[0]->site_lineid,
            'site_wechartid' => $Posts[0]->site_wechartid,
            'site_cellphone' => $Posts[0]->site_cellphone,
            'site_address' => $Posts[0]->site_address,
            'site_name_en' => $Posts[0]->site_name_en,
            'post_time' => $post->created_at,
            'description' => $Posts[0]->post_description,
            'Post' => $Posts,
            'id' => $post_id,
            'breadcrumbs' => $breadcrumbs,
            'menus' => $menus,
            'site' => $SitePaginate,
            'site_blade' => $site_blade,
            'PostPaginate' => $PostPaginate,
        ];
        // $News = DB::table('posts')
        //         ->where('posts.post_id','=',$news_id)
        //         ->join('sorts','sorts.sort_id','=','posts.post_sort')
        //         ->leftjoin('sites','sites.site_id','=','posts.post_site')
        //         ->get();
        //         // dd($News);
        // // if (!is_null($News->pic)) {
        // //     $News->pic = url($News->pic);
        // // }

        // $binding = [
        //     'title' => '編輯新聞',
        //     'News' => $News,
        //     'news_id' => $news_id,
        // ];
        
        if($SitePaginate[0]->site_maintain=='0'){
            return view('front.showPostItem', $binging);
        }else{
            return view('site.managelist', $binging);
        }
    }

    // 前台新聞內容
    public function newsFaqList($post_id)
    {
        $post = post::find($post_id);
        $Posts = DB::table('posts')
                ->where('posts.post_id','=',$post_id)
               // ->join('breadcrumbs','breadcrumbs.breadcrumb_id','=','posts.post_breadcrumb')
                ->join('sorts','sorts.sort_id','=','posts.post_sort')
                ->leftjoin('sites','sites.site_id','=','posts.post_site')
                ->get();
        $breadcrumbs = DB::table('breadcrumbs')->get();
        $menus = DB::table('menus')->get();
        // dd($Posts[0]->post_site);

        if($Posts[0]->post_site=='0'){
            return redirect('/news/noserve');
        }
        // session()->put('post_id', $post_id);
        // $user_id = session()->get('user_id');

        // dd($post_id);
        $binging = [
            'sort_name' => $Posts[0]->sort_name,
            'sort_name_en' => $Posts[0]->sort_name_en,
            'slide_no' => $Posts[0]->post_sort,
            'title' => $Posts[0]->post_title,
            'site_title' => $Posts[0]->site_title,
            'site_description' => $Posts[0]->site_description,
            'site_name' => $Posts[0]->site_name,
            'site_lineid' => $Posts[0]->site_lineid,
            'site_wechartid' => $Posts[0]->site_wechartid,
            'site_cellphone' => $Posts[0]->site_cellphone,
            'site_address' => $Posts[0]->site_address,
            'site_name_en' => $Posts[0]->site_name_en,
            'post_time' => $post->created_at,
            'description' => $Posts[0]->post_description,
            'Post' => $Posts,
            'id' => $post_id,
            'breadcrumbs' => $breadcrumbs,
            'menus' => $menus,
        ];
        // $News = DB::table('posts')
        //         ->where('posts.post_id','=',$news_id)
        //         ->join('sorts','sorts.sort_id','=','posts.post_sort')
        //         ->leftjoin('sites','sites.site_id','=','posts.post_site')
        //         ->get();
        //         // dd($News);
        // // if (!is_null($News->pic)) {
        // //     $News->pic = url($News->pic);
        // // }

        // $binding = [
        //     'title' => '編輯新聞',
        //     'News' => $News,
        //     'news_id' => $news_id,
        // ];
        return view('front.showPostItem', $binging);
    }
    // 新增輪播
    public function newsAddCarousel(){     
        $binding = [
            'title' => '新增輪播',
        ];
        return view('news.newsAddCarousel', $binding);
    }

    // 處理新增輪播
    public function newsAddCarouselDeal(request $request){
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [
            // 輪播名稱
            'carousel_title' => [
                'required',
                'max:80',
            ],
            // 輪播介紹
            'carousel_description' => [
                'required',
                'max:80',
            ],
            // 輪播圖片
            'carousel_image' => [
                'file',         
                'image',       
                'max: 10240',   
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/news/addcarousel')      
                ->withErrors($validator)
                ->withInput();
        }

        if (isset($input['carousel_image'])) {
            // 有上傳圖片
            $carousel_image = $input['carousel_image'];
            // 檔案副檔名
            $file_extension = $carousel_image->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = date('Ymdhis') . '_' . pathinfo($request->file("carousel_image")->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = '/images/present/' . $file_name;
            // 檔案存放目錄為對外公開public目錄下的相對位置
            $file_path = public_path($file_relative_path);
            // 裁切圖片
            $image = Image::make($carousel_image)->/*fit(250,100)->*/save($file_path);
            // 設定圖片檔案相對路徑
            $input['carousel_image'] = $file_relative_path;
        }   

        // 輪播資料更新
        $Carousel = carousel::create($input);

        // 重新導向到輪播編輯頁
        return redirect('/news/carouselManage');
    }

    // 此項目已無提供服務
    public function newsNoServe(){
        $Posts = DB::table('posts')
                ->join('sorts','sorts.sort_id','=','posts.post_sort')
                ->leftjoin('sites','sites.site_id','=','posts.post_site')
                ->get();
        $breadcrumbs = DB::table('breadcrumbs')->get();
        $menus = DB::table('menus')->get();
        $binging = [
            'site_name' => $Posts[0]->site_name,
            'site_name_en' => $Posts[0]->site_name_en,
            'site_lineid' => $Posts[0]->site_lineid,
            'site_wechartid' => $Posts[0]->site_wechartid,
            'site_cellphone' => $Posts[0]->site_cellphone,
            'site_address' => $Posts[0]->site_address,
            'site_title' => $Posts[0]->site_title,
            'site_description' => $Posts[0]->site_description,
            'slide_no' => $Posts[0]->post_sort,
            'breadcrumbs' => $breadcrumbs,
            'menu_post_time' => $menus[0]->menu_post_time,
            'menus' => $menus,
            'menu_name' => '',
            'menu_caption' => '',
            'menu_description' => '此項目已無提供服務'
        ];
        return view('front.showNoServe', $binging);
    }

    // 案例分享
    public function newsShare(){
        $row_per_page = 8;
        $post = post::all();
        $Posts = DB::table('posts')
                ->join('sorts','sorts.sort_id','=','posts.post_sort')
                ->leftjoin('sites','sites.site_id','=','posts.post_site')
                ->Paginate($row_per_page);
        $count = $Posts->total();
        $total_pages = ceil($count/$row_per_page);
        $site_blade = DB::table('sites')
                        // ->select('site_blade')
                        ->where('site_display' , '=' ,'1')
                        ->get();
        // $PostsLast = DB::table('posts')
        //         ->join('sorts','sorts.sort_id','=','posts.post_sort')
        //         ->leftjoin('sites','sites.site_id','=','posts.post_site')
        //         ->getLastPage($row_per_page);dd($PostsLast);
        // $PostsFirst = DB::table('posts')
        //         ->join('sorts','sorts.sort_id','=','posts.post_sort')
        //         ->leftjoin('sites','sites.site_id','=','posts.post_site')
        //         ->getCurrentPage($row_per_page);
        $breadcrumbs = DB::table('breadcrumbs')
                        ->where('breadcrumb_display','=','1')
                        ->get();
        $menus = DB::table('menus')->get();

        $SitePaginate = DB::table('sites')->get(); 
        
        $binging = [
            'sort_name' => $Posts[0]->sort_name,
            'sort_name_en' => $Posts[0]->sort_name_en,
            'site_name' => $Posts[0]->site_name,
            'site_name_en' => $Posts[0]->site_name_en,
            'site_lineid' => $Posts[0]->site_lineid,
            'site_wechartid' => $Posts[0]->site_wechartid,
            'site_cellphone' => $Posts[0]->site_cellphone,
            'site_address' => $Posts[0]->site_address,
            'site_title' => $Posts[0]->site_title,
            'site_description' => $Posts[0]->site_description,
            'slide_no' => 3,
            'site_name' => $Posts[0]->site_name,
            'site_blade' => $site_blade,
            'post_title' => $Posts[0]->post_title,
            'post_time' => $Posts[0]->post_time,
            'Post' => $Posts,
            'breadcrumbs' => $breadcrumbs,
            'menu_post_time' => '',
            'menu' => $menus,
            'menu_name' => '',
            'menu_caption' => $menus[0]->menu_caption,
            'menu_description' => $menus[0]->menu_description,
            'total_pages' => $total_pages,
            'site' => $SitePaginate,
        ];
        
        if($SitePaginate[0]->site_maintain=='0'){
            return view('front.showNewsShare', $binging);
        }else{
            return view('site.managelist', $binging);
        }
    }

    // 隨堂考
    public function newsFaq(){
        $row_per_page = 8;
        $post = post::all();
        $Faqs = DB::table('posts')
                ->where('posts.post_sort','=','4')
                ->join('sorts','sorts.sort_id','=','posts.post_sort')
                ->leftjoin('sites','sites.site_id','=','posts.post_site')
                ->Paginate($row_per_page);
        $count = $Faqs->total();
        $total_pages = ceil($count/$row_per_page);
        // $PostsLast = DB::table('posts')
        //         ->join('sorts','sorts.sort_id','=','posts.post_sort')
        //         ->leftjoin('sites','sites.site_id','=','posts.post_site')
        //         ->getLastPage($row_per_page);dd($PostsLast);
        // $PostsFirst = DB::table('posts')
        //         ->join('sorts','sorts.sort_id','=','posts.post_sort')
        //         ->leftjoin('sites','sites.site_id','=','posts.post_site')
        //         ->getCurrentPage($row_per_page);
        $breadcrumbs = DB::table('breadcrumbs')->get();
        $menus = DB::table('menus')->get();
        $SitePaginate = DB::table('sites')->get(); 
        
        $binging = [
            'sort_name' => $Faqs[0]->sort_name,
            'sort_name_en' => $Faqs[0]->sort_name_en,
            'site_name' => $Faqs[0]->site_name,
            'site_name_en' => $Faqs[0]->site_name_en,
            'site_lineid' => $Faqs[0]->site_lineid,
            'site_wechartid' => $Faqs[0]->site_wechartid,
            'site_cellphone' => $Faqs[0]->site_cellphone,
            'site_address' => $Faqs[0]->site_address,
            'site_title' => $Faqs[0]->site_title,
            'site_description' => $Faqs[0]->site_description,
            'slide_no' => 3,
            'site_name' => $Faqs[0]->site_name,
            'post_title' => $Faqs[0]->post_title,
            'post_time' => $Faqs[0]->post_time,
            'Faq' => $Faqs,
            'breadcrumbs' => $breadcrumbs,
            'menu_post_time' => '',
            'menu' => $menus,
            'site' => $SitePaginate,
            'menu_name' => '',
            'menu_caption' => $menus[0]->menu_caption,
            'menu_description' => $menus[0]->menu_description,
            'total_pages' => $total_pages,
        ];
        
        if($SitePaginate[0]->site_maintain=='0'){
            return view('front.showNewsFaq', $binging);
        }else{
            return view('site.managelist', $binging);
        }
    }

    //更新新聞檢視
    public function newsChangeNewsDisplay(Request $request,$id){ 
  
        $post_display = $request->post_display;
        // dd($post_display);
        if($post_display=='1'){
            $post_display='0';
        }else if($post_display=='0'){
            $post_display='1';
        }

        $post = post::find($id);
        $post->update([
            'post_display' => $post_display,
        ]);
        $currentUrl = url()->previous();
        return redirect($currentUrl);
    }

    //更新輪播檢視
    public function newsChangeCarouselDisplay(Request $request,$carousel_id){ 
        
        $carousel_display = $request->carousel_display;
        
        if($carousel_display=='1'){
            $carousel_display='0';
        }else if($carousel_display=='0'){
            $carousel_display='1';
        }
        // dd($carousel_display);
        $carousel = carousel::find($carousel_id);
        $carousel->update([
            'carousel_display' => $carousel_display,
        ]);
        $currentUrl = url()->previous();
        return redirect($currentUrl);
    }

    //更新麵包屑檢視
    public function newsChangebreadcrumbDisplay(Request $request,$id){ 
        
        $breadcrumb_display = $request->breadcrumb_display;
        
        if($breadcrumb_display=='1'){
            $breadcrumb_display='0';
        }else if($breadcrumb_display=='0'){
            $breadcrumb_display='1';
        }
        // dd($breadcrumb_display);
        $breadcrumb = breadcrumb::find($id);
        $breadcrumb->update([
            'breadcrumb_display' => $breadcrumb_display,
        ]);
        $currentUrl = url()->previous();
        return redirect($currentUrl);
    }

    //更新類別檢視
    public function newsChangeSortDisplay(Request $request,$id){ 
        // dd($request);
        $sort_display = $request->sort_display;
        
        if($sort_display=='1'){
            $sort_display='0';
        }else if($sort_display=='0'){
            $sort_display='1';
        }

        $sort = sort::find($id);
        $sort->update([
            'sort_display' => $sort_display,
        ]);
        $currentUrl = url()->previous();
        return redirect($currentUrl);
    }

    //更新選單檢視
    public function newsChangeMenuDisplay(Request $request,$id){ 
      
        $menu_display = $request->menu_display;
       
        if($menu_display=='1'){
            $menu_display='0';
        }else if($menu_display=='0'){
            $menu_display='1';
        }

        $menu = menu::find($id);
        $menu->update([
            'menu_display' => $menu_display,
        ]);
        $currentUrl = url()->previous();
        return redirect($currentUrl);
    }

    public function newsCarouselManage(){
        // 每頁資料量
        $row_per_page = 10;
            
        $CarouselPaginate  = DB::table('carousels')
                    ->paginate($row_per_page);
        $binging = [
            'title' => '輪播管理',
            'CarouselPaginate' => $CarouselPaginate,
        ];
        return view('news.newsCarouselManage', $binging);
    }

    //輪播圖片更新
    public function newsCarouselEdit($Carousel_id){
        //$News = carousels::findOrFail($news_id);
        $Carousels = DB::table('carousels')
                    ->where('carousels.carousel_id','=',$Carousel_id)
                    ->get();
       

        $binding = [
            'title' => '編輯新聞',
            'Carousel_id' => $Carousel_id,
            'Carousels' => $Carousels,
        ];

        return view('news.newsCarouselEdit', $binding);
    }

    // 輪播圖片更新處理
    public function newsCarouselEditDeal(request $request,$Carousel_id) {
        
        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 輪播名稱
            'carousel_title' => [
                'required',
                'max:80'
            ],
            // 輪播說名
            'carousel_description' => [
                'required',
                'max:80'
            ],
            // 輪播圖片
            'carousel_image' => [
                'nullable',               // 允許不更新圖片
                'image',                  // 限制必須是圖片格式 (jpeg, png, bmp, gif, svg, webp)
                'mimes:jpeg,png,jpg,webp',// 嚴格限制副檔名 (選填)
                'max:2048'                // 限制檔案最大 2048 KB (即 2MB)
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
             // 資料驗證錯誤
             return redirect('/news/'.$Carousel_id.'/carouselEdit')      
                 ->withErrors($validator)
                 ->withInput();
         }

         if (isset($input['carousel_image'])) {
            // 有上傳圖片
            $pic = $input['carousel_image'];
            // 檔案副檔名
            $file_extension = $pic->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = date('Ymdhis') . '_' . pathinfo($request->file("carousel_image")->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = '/images/present/' . $file_name;
            // 檔案存放目錄為對外公開public目錄下的相對位置
            $file_path = public_path($file_relative_path);
            // 裁切圖片
            $image = Image::make($pic)->save($file_path);
            // 設定圖片檔案相對路徑
            $input['carousel_image'] = $file_relative_path;
            
        }

        $carousel = carousel::find($Carousel_id);
        $carousel->update([
            'carousel_title' => $request->carousel_title,
            'carousel_description' => $request->carousel_description,
            'carousel_image' => $input['carousel_image'],
        ]);
        return redirect('/news/'.$Carousel_id.'/carouselEdit');
    }

    public function joinClass()
    {   
        // 接收輸入資料
        $input = request()->all();
        $Course_id = session()->get('class_id');
        $Course = DB::table('class')->where('id', '=' ,$Course_id)->select('quota')->get();
        foreach ($Course as $Course) {
           $Course=$Course->quota;
        }

        if ($Course == 0) {
            // 預約課程後剩餘數量小於 0，不足以給使用者預約
            // 顯示('報名人次已額滿');
            $message = [
                'msg' => [
                    '報名人次已額滿',
                ],
            ];

            return redirect()
                ->to('/class/' . $Course_id . '/itm')
                ->withErrors($message);
        }else{
            $binding = [
                'title' => '課程與活動預約',
                'Course_id' => $Course_id,
            ];

            return view('front.joinClass', $binding);
        }
       
    }

    public function newsIndexPageUp($id){
        // 每頁資料量
    	$row_per_page = 5;
        
    	// 撈取新聞分頁資料
        $PostPaginate = DB::table('posts')
            ->where('posts.post_sort','=','3')
            ->join('sorts','sorts.sort_id','=','posts.post_sort')
            ->leftjoin('sites','sites.site_id','=','posts.post_site')
            ->where('post_display','=','1')
            ->OrderBy('post_id', 'asc')
            ->paginate($row_per_page);
            // dd($PostPaginate->currentPage());
            // dd($PostPaginate->firstItem());
            // dd($PostPaginate->hasMorePages());
            // dd(count(post::where('post_display','=','1')->paginate()->items()));
            // dd(count(post::paginate()->items()));
            // dd($PostPaginate->currentPage());
        if($PostPaginate->currentPage()>1){
            $FaqPaginate = DB::table('posts')
                        ->where('posts.post_sort','=','4')
                        ->join('sorts','sorts.sort_id','=','posts.post_sort')
                        ->leftjoin('sites','sites.site_id','=','posts.post_site')
                        ->where('post_display','=','1')
                        ->take(5)
                        ->OrderBy('post_id', 'asc')
                        ->paginate($row_per_page);
                        dd('1');
        }else{
            $FaqPaginate = DB::table('posts')
                        ->where('posts.post_sort','=','4')
                        ->join('sorts','sorts.sort_id','=','posts.post_sort')
                        ->leftjoin('sites','sites.site_id','=','posts.post_site')
                        ->where('post_display','=','1')
                        ->take(5)
                        ->OrderBy('post_id', 'asc')
                        ->get();
        }
        
        $count = $PostPaginate->total();
        $total_pages = ceil($count/$row_per_page);
        $SitePaginate = DB::table('sites')->get();
        $CarouselPaginate = DB::table('carousels')->get();
		// 設定新聞標題網址
        // foreach ($PostPaginate as &$Post) {
        //     if (!is_null($Post->title)) {
        //         // 設定課程照片網址
        //         $Post->title = url($Post->title);
        //     }
            
        // } 
// dd($PostPaginate[0]->site_title);
            $site_maintain_loginapi = '/login';
            $site_maintain_loginname = '[快速登入]';
        // if(Auth::user()->type=='A' and Auth::user()->type=='G'){
        //     $site_maintain_loginapi = '/home';
        //     $site_maintain_loginname = '[前往後臺]';
        // }
        // if(Auth::user()->type=='null'){
        //     $site_maintain_loginapi = '/login';
        //     $site_maintain_loginname = '[快速登入]';
        // }

    	$binging = [
            'title' => $PostPaginate[0]->site_title,
            'description' => $PostPaginate[0]->site_description,
    		'PostPaginate' => $PostPaginate,
            'FaqPaginate' => $FaqPaginate,
            'total_pages' => $total_pages,
            'site' => $SitePaginate,
            'CarouselPaginate' => $CarouselPaginate,
            'site_maintain_loginapi' => $site_maintain_loginapi,
            'site_maintain_loginname' => $site_maintain_loginname,
    	];
        if($SitePaginate[0]->site_maintain=='0'){
            return view('front.classItem', $binging);
        }else{
            return view('site.managelist', $binging);
        }   
    	
    }

     // 新增報名(處理)
    public function joinClassAdd(){
         $user_id = session()->get('user_id');
         $JoinPaginate = pluss::where('user_id', $user_id)
            ->OrderBy('created_at', 'desc')
            ->get();
        $id = session()->get('id');
        $user_id = session()->get('user_id');
        $Course = course::findOrFail($id);
        $Course2 = DB::table('class')->where('id', '=' ,$Course->id)->get();
        foreach ($Course2 as $Course2) {
           $Course_id=$Course->id;
        }
        $binding = [
            'title' => '課程與活動預約',
            'Course_id' => $Course_id,
        ];

        return view('front.joinClass', $binding);
    }
 
    // 新增報名增加(處理)
    public function joinClassDeal(){

        // 接收輸入資料
        $input = request()->all();
        
        // 驗證規則
        $rules = [
            // 姓名
            'nickname'=> [
                'required',
            ],
            // 生日
            'birth' => [
                'required',
            ],
            // 電話
            'phone' => [
                'required',
            ],
            // 地址
            'city' => [
                'required',
                'max:80',
            ],
            // Email
            'email' => [
                'required',
                'email',
                'unique:pluss,email,NULL,id,class_id,'.$input['class_id'].'',
                'max:150',
            ],
        ];


        // 驗證資料
        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/class/join')
                ->withErrors($validator)
                ->withInput();
        }
        $Course_id = session()->get('class_id');
        $user_id = Auth::user()->id;
        $User = user::findOrFail($user_id);

        // 撈取報名資料
        $Course = DB::table('pluss')->where('user_id', '=' ,$user_id)->where('class_id', '=' ,$input['class_id'])->select('class_id')->get();

        
        $Course = json_decode(json_encode($Course));

        $Class_id = json_decode($input['class_id']);
        foreach ($Course as $Course1) {
            $Course2=json_decode($Course1->class_id);
            if ($Course2==$Class_id){
                $message = [
                    'msg' => [
                        '此課程已報名過',
                    ],
                ];
                return redirect()
                ->to('/class/join/')
                ->withErrors($message);
            }
        }

        $join_data = [
            'class_id' => $input['class_id'],   // 報名課程ID
            'user_id' => $User->id,             // 使用者ID
            'nickname'  => $User->name,         // 姓名
            'birth' => $input['birth'],         // 生日
            'phone' => $input['phone'],         // 電話
            'city' => $input['city'],           // 住址
            'email' => $User->email,            // 信箱
        ];
        $Join = pluss::create($join_data);
    
        // 撈取報名資料
        $Course = DB::table('class')->where('id', '=' ,$input['class_id'])->select('quota')->get();
        foreach ($Course as $Course) {
           $Course=$Course->quota;
        }
        
        if ($Course == 0) {
            // 預約課程後剩餘數量小於 0，不足以給使用者預約
            // 顯示('報名人次已額滿');
            $message = [
                'msg' => [
                    '報名人次已額滿',
                ],
            ];

            return redirect()
                ->to('/class/' . $Join->id . '/joins')
                ->withErrors($message);
        }else{
            echo "尚未進行繳費";
            // exit;
            
            //$course = DB::table('class')->where('id', '=' ,$input['class_id'])->decrement('quota', 1);
            $course2 = DB::table('pluss')->join('class','pluss.class_id','=','class.id')->where('class_id', '=' ,$input['class_id'])->get();
            foreach ($course2 as $value) {
               $course=$value->name;
            }
            
            include('checkpay.php');
            // 報名資料更新
            $Join->update($input);
            
            $message = [
                'msg' => [
                    '報名成功',
                ],
            ];
            
        }
        
        // 重新導向到商品編輯頁
        return redirect('/')->withErrors($message);
        
    }

    public function exportAllClass()
    {
        return Excel::download(new CourseExportAll, 'course.xlsx');
    }

    public function export($course_id)
    {
        $Course = course::findOrFail($course_id);
        session()->put('class_id', $Course->id);
        return Excel::download(new CourseExport, 'course.xlsx');
    }
}