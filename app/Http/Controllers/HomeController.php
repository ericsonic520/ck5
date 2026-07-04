<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Site;
use App\Models\course;
use DOMDocument;
use Validator;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        // 每頁資料量
        $row_per_page = 10;
        // 撈取課程分頁資料
        $PostPaginate = DB::table('posts')
            ->join('sorts','sorts.sort_id','=','posts.post_sort')
            ->leftjoin('sites','sites.site_id','=','posts.post_site')
            ->orderBy('post_id', 'asc')
            ->paginate($row_per_page);
       
        $binding = [
            'title' => '新聞列表',
            'PostPaginate' => $PostPaginate,
        ];
        return view('news.newsList', $binding);
    }

    //新增新聞
    public function newsAdd(Request $request)
    {   
        $description = $request->post_description;
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 新聞標題
            'post_title' => [
                'required',
                'max:80'
            ],
            // 新聞類別
            'post_sort' => [
                'in:1,2,3,4'
            ],
            // 新聞內容
            'post_description' => [
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
        post::create([
            'post_title' => $request->post_title,
            'post_sort' => $request->post_sort,
            'post_description' => $description,
            'post_site' => 1,
            'post_display' => 1,    //預設新增新聞為檢視
            'create_time' => date("Y/m/d H:i:s"),
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
        return redirect('news');
    } //   $dom->loadHTML($description,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    public function show_data(){
        $data=Post::all();

        return view('post_data', compact('data'));
    }

    // 更新新聞頁面
    public function newsUpd(Request $request,$id)
    {   
        $description = $request->post_description;
        $post = post::find($id);
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [       
            // 新聞標題
            'post_title' => [
                'required',
                'max:80',
            ],
            // 新聞類別
            'post_sort' => [
                'required',
                'in:1,2,3,4'
            ],
            // 新聞內容
            'post_description' => [
                'required',
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/news/'.$id.'/edit')      
                ->withErrors($validator)
                ->withInput();
        }

        //$Post = DB::table('posts')->where("id","=",$request->id)->get();
       
        
        $title = $request->post_title;
        $sort = $request->post_sort;
        //dd($description);
        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'));
       
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
        $description = $dom->saveHTML();
    
        // $post = new Post;       
        // $post->title = $title;
        // $post->sort = $sort;
        // $post->description = $description;      
        // $post->update();
        
        // // 每頁資料量
        // $row_per_page = 8;
        // // 撈取商品分頁資料
        // $PostPaginate = Post::OrderBy('id', 'asc')
        //     ->paginate($row_per_page);      
        $post->update([
            'post_title' => $request->post_title,
            'post_sort' => $sort,
            'post_description' => $description
        ]);
        // $binding = [
        //     'title' => '新聞列表',
        //     'PostPaginate' => $PostPaginate,
        // ];
        // return redirect()->back();
        // return view('news.post_data', $binding);
        // return view('News.newsList', $binding);
        return redirect('/news/'.$id.'/edit');
    }
}
