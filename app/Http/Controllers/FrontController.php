<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\user; 
use App\Models\pluss;
use App\Models\post;
use Validator;
use Exception;
use DB;
use Auth;

class FrontController extends Controller
{
	// 新聞列表【前台】【首頁】
    public function classIndex()
    {
    	// 每頁資料量
    	$row_per_page = 5;
        
        // 麵包序資料
        $Breadcrumbs = DB::table('breadcrumbs')->get();

    	// 撈取新聞分頁資料
        $PostPaginate = DB::table('posts')
            // ->where('posts.post_sort','=','3')
            ->join('sorts','sorts.sort_id','=','posts.post_sort')
            ->leftjoin('sites','sites.site_id','=','posts.post_site')
            ->where('post_display','=','1')
            ->OrderBy('post_id', 'asc')
            ->paginate();
            // ->get();
        $postall = count($PostPaginate);    
            // dd($PostPaginate->currentPage());
            // dd($PostPaginate->firstItem());
            // dd($PostPaginate->hasMorePages());
            // dd(count(post::where('post_display','=','1')->paginate()->items()));
            // dd(count(post::paginate()->items()));
        $FaqPaginate = DB::table('posts')
            ->where('posts.post_sort','=','4')
            ->join('sorts','sorts.sort_id','=','posts.post_sort')
            ->leftjoin('sites','sites.site_id','=','posts.post_site')
            ->where('post_display','=','1')
            ->OrderBy('post_id', 'asc')
            ->paginate($row_per_page);
        $faqall = count($FaqPaginate);
           $post = post::where('posts.post_sort','=','4')
                    ->join('sorts','sorts.sort_id','=','posts.post_sort')
                    ->leftjoin('sites','sites.site_id','=','posts.post_site')
                    ->where('post_display','=','1')
                    ->OrderBy('post_id', 'asc')
                    ->paginate($row_per_page);
           $FaqPaginate->setPath(url('custom/url'));
           $FaqPaginate->appends(['sort' => 'votes'])->links();
        $count = $PostPaginate->total();
        $total_pages = ceil($count/$row_per_page);
        $SitePaginate = DB::table('sites')->get();
        $site_blade = DB::table('sites')
                        // ->select('site_blade')
                        ->where('site_display' , '=' ,'1')
                        ->get();
        // dd($site_blade);
        $CarouselPaginate = DB::table('carousels')
                        ->where('carousel_display' , '=' ,'1')
                        ->get();
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

        $presents = DB::table('presents')
                        ->where('presents.resume_display','=','1')
                        ->get();
       $master_presents = DB::table('presents')->get();    
        if(!$master_presents->contains('resume_display', 1)){
            echo '目前沒有選擇任何一個履歷頁面';
            return;
        }
        $resume_experience = $presents[0]->resume_experience;
        $resume_experience_echo = json_decode($resume_experience,true);

    	$binging = [
            'breadcrumbs' => $Breadcrumbs,
            'presents' => $presents,
            'resume_experience_echo' => $resume_experience_echo,
            'title' => $PostPaginate[0]->site_title,
            'description' => $PostPaginate[0]->site_description,
            'site_name' => $PostPaginate[0]->site_name,
            'site_name_en' => $PostPaginate[0]->site_name_en,
    		'PostPaginate' => $PostPaginate,
            'FaqPaginate' => $FaqPaginate,
            'postall' => $postall,
            'faqall' => $faqall,
            'total_pages' => $total_pages,
            'site_blade' => $site_blade[0]->site_blade,
            'site' => $SitePaginate,
            'CarouselPaginate' => $CarouselPaginate,
            'site_maintain_loginapi' => $site_maintain_loginapi,
            'site_maintain_loginname' => $site_maintain_loginname,
    	];
        if($site_blade[0]->site_maintain=='0'){
            return view($site_blade[0]->site_blade, $binging);
        }else if($site_blade[0]->site_maintain=='1'){
            return view('site.managelist', $binging);
        }  
    	
    }  
}