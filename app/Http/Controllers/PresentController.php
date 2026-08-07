<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\present;
use App\Models\presents_sixes;
use App\Models\presents_marries;
use Storage;
use DB;
use Image;
use Validator;

class PresentController extends Controller
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
    // 首頁
    public function presentList()
    {
        $Posts = DB::table('posts')
                ->join('sorts','sorts.sort_id','=','posts.post_sort')
                ->leftjoin('sites','sites.site_id','=','posts.post_site')
                ->get();
        $row_per_page = 10;
        $PostPaginate = DB::table('posts')
                        ->OrderBy('post_id', 'asc')
                        ->join('sorts','sorts.sort_id','=','posts.post_sort')
                        ->leftjoin('sites','sites.site_id','=','posts.post_site')
                        ->paginate($row_per_page);
        $breadcrumbs = DB::table('breadcrumbs')
                        ->where('breadcrumbs.breadcrumb_display','=','1')
                        ->get();
        $presents = DB::table('presents')
                        ->where('presents.resume_display','=','1')
                        ->get();
        // dd($presents[0]->resume_experience);
        $resume_experience = $presents[0]->resume_experience;
        $resume_experience_echo = json_decode($resume_experience,true);

        $resume_skill = $presents[0]->resume_skill;
        $resume_skill_echo = json_decode($resume_skill,true);
        // dd($Posts[0]->post_site);

        // if($Posts[0]->post_site=='0'){
        //     return redirect('/news/noserve');
        // }
        // session()->put('post_id', $post_id);
        // $user_id = session()->get('user_id');

        // dd($post_id);

        $SitePaginate = DB::table('sites')
                        ->where('site_id','=','2')
                        ->get();
        
        $binging = [
            // 'sort_name' => $Posts[0]->sort_name,
            // 'sort_name_en' => $Posts[0]->sort_name_en,
            // 'slide_no' => $Posts[0]->post_sort,
            'title' => $Posts[0]->post_title,
            // 'site_title' => $Posts[0]->site_title,
            // 'site_description' => $Posts[0]->site_description,
            'site_name' => $Posts[0]->site_name,
            // 'site_lineid' => $Posts[0]->site_lineid,
            // 'site_wechartid' => $Posts[0]->site_wechartid,
            // 'site_cellphone' => $Posts[0]->site_cellphone,
            // 'site_address' => $Posts[0]->site_address,
            'site_name_en' => $Posts[0]->site_name_en,
            // // 'post_time' => $post->created_at,
            'description' => $Posts[0]->post_description,
            // 'Post' => $Posts,
            // // 'id' => $post_id,
            'breadcrumbs' => $breadcrumbs,
            'presents' => $presents,
            'resume_experience_echo' => $resume_experience_echo,
            // 'menus' => $menus,
            'site' => $SitePaginate,
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
            return view('present.presentList', $binging);
        }else{
            return view('site.managelist', $binging);
        }
    }

    public function presentGetStar(Request $request)
    {
        // 驗證輸入內容，分數需在 1~5 之間
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // 儲存到資料庫或處理業務邏輯
        // $product->ratings()->create(['score' => $request->rating]);

        return back()->with('success', '感謝您的評分：' . $request->rating . ' 顆星');
    }

    // 履歷表新增
    public function resumeAddId() {
     
                
        $binding = [
            'phone_reg' => 'RegExp(/^09\d{2}-?\d{3}-?\d{3}$/)',
            'title' => '新增履歷',
            'back' => '<-',
        ];
        return view('present.resumeAdd', $binding);
    }

    // 履歷表新增處理
    public function resumeAddIdDeal(Request $request) {dd('2');

        // 解碼 JSON 字串
        $data = json_decode($request->input('payload'), true);
        // 打包所有接收回來的欄位
        $data2 = [
            "resume_name" => $request['resume_name'],
            "resume_nickname" => $request['resume_nickname'],
            "resume_picme" => $request['resume_picme'],
            "resume_sex" => $request['resume_sex'],
            "resume_age" => $request['resume_age'],
            "resume_marry" => $request['resume_marry'],
            "resume_education" => $request['resume_education'],
            "resume_cellphone" => $request['resume_cellphone'],
            "resume_email" => $request['resume_email'],
            "resume_introduction" => $request['resume_introduction'],
            "payload" => $request['payload'],
            "resume_picme" => $request['resume_picme'],
            "resume_summary" => $request['resume_summary'],
            "resume_display" => $request['resume_display'],
        ];

        // 將陣列轉換成 JSON 字串
        $jsonString = json_encode($data2);
        $jsonString_decode = json_decode($jsonString, true);
        $payload = json_decode($jsonString_decode['payload'], true);

        $experiences = $payload['experiences'];
        $experiences_encode = json_encode($experiences);   
        $experiences_decode = json_decode($experiences_encode,true);
       
        $skills = $payload['skills']; 
        $skills_encode = json_encode($skills);   
        $skills_decode = json_decode($skills_encode,true);
        $i=0;
        foreach ($experiences_decode as $key=>$value){
            $payload = $jsonString_decode['payload'];
            $period = $experiences_decode[$key]['period'];
            $company = $experiences_decode[$key]['company'];
            $title = $experiences_decode[$key]['title'];
        
        // dd($period);
        $i++;
        }

        

        $j=0;
        foreach ($skills_decode as $key=>$value){
            $payload = $jsonString_decode['payload'];
            $type = $skills_decode[$key]['type'];
            $name = $skills_decode[$key]['name'];
            $level = $skills_decode[$key]['level'];

            
        $j++;
        }
        if (!$data) {
            return back()->with('error', '資料傳輸失敗');
        }

        // 存取範例
        // $data['experiences']
        // $data['skills']

        // 這裡進行 DB 更新邏輯...

        // return response()->json([
        //     'status' => 'success',
        //     'received' => $data
        // ]);

        // 接收輸入資料
        $input = request()->all();
        $input2 = $request;
// dd($request->work_time[0]);
        // 驗證規則
        $rules = [
            // 履歷表名稱
            'resume_name' => [
                'required',
                'max:80'
            ],      
            // 履歷表匿稱
            'resume_nickname' => [
                'required',
                'max:80'
            ],
            // 履歷表性別
            'resume_sex' => [
                'required',
                'max:80'
            ],
            // 履歷表年齡
            'resume_age' => [
                'required',
                'max:80'
            ],
            // 履歷表婚姻
            'resume_marry' => [
                'required',
            ],
            // 履歷表學歷
            'resume_education' => [
                'required',
                'max:80'
            ],
            // 履歷表手機
            'resume_cellphone' => [
                'required',
                'max:10'
            ],
            // 履歷表信箱
            'resume_email' => [
                'required',
                'max:80'
            ],
            // 履歷表簡介
            'resume_introduction' => [
                'required',
                'max:80'
            ],
            // 履歷表期間
            'resume_period' => [
                'max:80'
            ],
            // 履歷表公司
            'resume_company' => [
                'max:80'
            ],
            // 履歷表職稱
            'resume_title' => [
                'max:80'
            ],
            // 履歷表技能
            'resume_skill' => [
                'max:80'
            ],
            // 履歷表圖片
            'resume_picme' => [
                'required',
                'max:80'
            ],
            // 履歷表自我介紹
            'resume_summary' => [
                'required',
                'max:80'
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
             // 資料驗證錯誤
             return redirect('/present/add')      
                 ->withErrors($validator)
                 ->withInput();
         }

        //============================================Aaary轉json網路示範
        //         $ids = [1, 2, 3];
        // $names = ['Alice', 'Bob', 'Charlie'];
        // $emails = ['alice@test.com', 'bob@test.com', 'charlie@test.com'];

        // $combined = [];

        // // 使用迴圈合併
        // foreach ($ids as $key => $id) {
        //     $combined[] = [
        //         'id'    => $id,
        //         'name'  => $names[$key] ?? '',
        //         'email' => $emails[$key] ?? ''
        //     ];
        // }

        // // 轉換為 JSON
        // $json_output = json_encode($combined, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // echo $json_output;
        //============================================Aaary轉json網路示範
        // dd($input2);
                $resume_period = $input2->resume_period;
                $resume_company = $input2->resume_company;
                $resume_title = $input2->resume_title;
                $resume_skill = $input2->resume_skill;
                $resume_skill_type = $input2->resume_skill_type;
                $payload=json_decode($input2['payload'],true);
                // dd($input2->resume_skill_type);
            $data=[];
            $data2=[];
            foreach($resume_company as $key=> $id){
                
                $data[] = [
                        'ID' => $key+1,
                        '在職時間' => $resume_period[$key],
                        '公司' => $resume_company[$key],
                        '職稱' => $resume_title[$key],
                ];
            }
            foreach($resume_skill as $key=> $id){
                
                    if($resume_skill_type[$key]=='frontend'){
                        $data2[] = [
                                'id' => $key+1,
                                'type' => 'frontend',
                                'skill' => $resume_skill[$key],
                                'trained'=> $payload['skills'][$key]['level'],
                        ];
                    }
                    if($resume_skill_type[$key]=='backend'){
                        $data2[] = [
                                'id' => $key+1,
                                'type' => 'backend',
                                'skill' => $resume_skill[$key],
                                'trained'=> $payload['skills'][$key]['level'],
                        ];
                    }
                   
            };
            $resume_experiences = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $resume_experiences_echo = json_encode($data, JSON_UNESCAPED_UNICODE);
                echo $resume_experiences;
            $resume_experiences_decode = json_decode($resume_experiences,true);

            

            $resume_skills = json_encode($data2, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $resume_skills_echo = json_encode($data2, JSON_UNESCAPED_UNICODE);
                echo $resume_skills;
            $resume_skills_decode = json_decode($resume_skills,true);

        if ($request->hasFile('resume_picme') && isset($input2->resume_picme)) {
            // 原始檔名
            $fileName = $_FILES['resume_picme']['name'];
            // 取出原始檔名的檔案名稱
            $name = pathinfo($fileName, PATHINFO_FILENAME);
            // 有上傳圖片
            $pic = $input2->resume_picme;
            // 檔案副檔名
            $file_extension = $pic->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = $name . '-' . date('Y'.'m'.'d'.'H'.'i'.'s') . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/present/' . $file_name;
            // 檔案存放目錄為對外公開public目錄下的相對位置
            $file_path = public_path($file_relative_path);
            // 裁切圖片
            $image = Image::make($pic)->save($file_path);
            // 設定圖片檔案相對路徑
            $input2->resume_picme = $file_relative_path;
        }else{
            $input2->resume_picme = '照片沒有上傳成功';
        } 

        present::create([
                    'resume_name' => $input2->resume_name,
                    'resume_nickname' => $input2->resume_nickname,
                    'resume_picme' => $input2->resume_picme,
                    'resume_sex' => $input2->resume_sex,
                    'resume_age' => $input2->resume_age,
                    'resume_marry' => $input2->resume_marry,
                    'resume_education' => $input2->resume_education,
                    'resume_cellphone' => $input2->resume_cellphone,
                    'resume_email' => $input2->resume_email,
                    'resume_introduction' => $input2->resume_introduction,
                    'resume_experience' => $resume_experiences_echo,
                    'resume_skill' => $resume_skills_echo,
                    'resume_picme' => $input2->resume_picme,
                    'resume_summary' => $input2->resume_summary,
                    'resume_display' => $input2->resume_display,
                ]);
        $ResumePaginate = $request;
        // 重新導向到履歷管理頁
        return redirect('/present/manage');
    }

    // 更新單一履歷
    public function resumeEditDeal(Request $request) {
        $resume_experience_echo = json_encode($request['resume_experience_decode'],JSON_UNESCAPED_UNICODE);
        $resume_skill_echo = json_encode($request['resume_skill_decode'],JSON_UNESCAPED_UNICODE);

        $resume_id = session()->get('resume_id');

        // 接收輸入資料
        $input = request()->all();
        $input2 = $request;
        $resume_experiences_decode = $input2['resume_experience_decode'];
        $resume_skills_decode = $input2['resume_skill_decode'];

        $rules = [
            // 履歷表名稱
            'resume_name' => [
                'required',
                'max:80'
            ],      
            // 履歷表匿稱
            'resume_nickname' => [
                'required',
                'max:80'
            ],
            // 履歷表性別
            'resume_sex' => [
                'required',
                'max:80'
            ],
            // 履歷表年齡
            'resume_age' => [
                'required',
                'max:80'
            ],
            // 履歷表婚姻
            'resume_marry' => [
                'required',
            ],
            // 履歷表學歷
            'resume_education' => [
                'required',
                'max:80'
            ],
            // 履歷表手機
            'resume_cellphone' => [
                'required',
                'max:10'
            ],
            // 履歷表信箱
            'resume_email' => [
                'required',
                'max:80'
            ],
            // 履歷表簡介
            'resume_introduction' => [
                'required',
                'max:80'
            ],
            // 履歷表期間
            'resume_period' => [
                'max:80'
            ],
            // 履歷表公司
            'resume_company' => [
                'max:80'
            ],
            // 履歷表職稱
            'resume_title' => [
                'max:80'
            ],
            // 履歷表技能
            'resume_skill' => [
                'max:80'
            ],
            // 履歷表圖片
            'resume_picme' => [
                'required',
                'max:80'
            ],
            // 履歷表自我介紹
            'resume_summary' => [
                'required',
                'max:80'
            ],
        ];

         // 驗證資料
        $validator = Validator::make($input, $rules);
 
        if ($validator->fails()) {
             // 資料驗證錯誤
             return redirect('/present/add')      
                 ->withErrors($validator)
                 ->withInput();
         }

    // foreach($resume_experiences_decode as $key => $experiences){
    //     $resume_experiences_id = $resume_experiences_decode[$key]['ID'];
    //     $resume_period = $resume_experiences_decode[$key]['在職時間'];
    //     $resume_company = $resume_experiences_decode[$key]['公司'];
    //     $resume_title = $resume_experiences_decode[$key]['職稱'];
    // }

    // foreach($resume_skills as $key => $skills){
    //     if($resume_skills[$key]['type']=="frontend"){
    //         $resume_skills_id = $resume_skills_decode[$key]['id'];
    //         $resume_skills_type = $resume_skills_decode[$key]['type'];
    //         $resume_skills_skill = $resume_skills_decode[$key]['skill'];
    //         $resume_skills_trained = $resume_skills_decode[$key]['trained'];
    //     }
    //     if($resume_skills[$key]['type']=="backend"){
    //         $resume_skills_id = $resume_skills_decode[$key]['id'];
    //         $resume_skills_type = $resume_skills_decode[$key]['type'];
    //         $resume_skills_skill = $resume_skills_decode[$key]['skill'];
    //         $resume_skills_trained = $resume_skills_decode[$key]['trained'];
    //     }
    // }
    //     $resume_skills = $input2['resume_skill'];
    //     $resume_skill_type = $input2->resume_skill_type;
    //     $payload=json_decode($input2['payload'],true);
    //         // dd($input2->resume_skill_type);
    //     $data=[];
    //     $data2=[];
    //     foreach($resume_company as $key=> $id){
            
    //         $data[] = [
    //                 'ID' => $key+1,
    //                 '在職時間' => $resume_period[$key],
    //                 '公司' => $resume_company[$key],
    //                 '職稱' => $resume_title[$key],
    //         ];
    //     }
    //     foreach($resume_skill as $key=> $id){
            
    //             if($resume_skill_type[$key]=='frontend'){
    //                 $data2[] = [
    //                         'id' => $key+1,
    //                         'type' => 'frontend',
    //                         'skill' => $resume_skill[$key],
    //                         'trained'=> $payload['skills'][$key]['level'],
    //                 ];
    //             }
    //             if($resume_skill_type[$key]=='backend'){
    //                 $data2[] = [
    //                         'id' => $key+1,
    //                         'type' => 'backend',
    //                         'skill' => $resume_skill[$key],
    //                         'trained'=> $payload['skills'][$key]['level'],
    //                 ];
    //             }
                
    //     };
    //     $resume_experiences = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    //     $resume_experiences_echo = json_encode($data, JSON_UNESCAPED_UNICODE);
    //         echo $resume_experiences;
    //     $resume_experiences_decode = json_decode($resume_experiences,true);

        

    //     $resume_skills = json_encode($data2, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    //     $resume_skills_echo = json_encode($data2, JSON_UNESCAPED_UNICODE);
    //         echo $resume_skills;
    //     $resume_skills_decode = json_decode($resume_skills,true);
         
        $present = present::find($resume_id);
        $present->update([
            'resume_name' => $input2->resume_name,
            'resume_nickname' => $input2->resume_nickname,
            'resume_sex' => $input2->resume_sex,
            'resume_age' => $input2->resume_age,
            'resume_marry' => $input2->resume_marry,
            'resume_education' => $input2->resume_education,
            'resume_cellphone' => $input2->resume_cellphone,
            'resume_email' => $input2->resume_email,
            'resume_introduction' => $input2->resume_introduction,
            'resume_experience' => $resume_experience_echo,
            'resume_skill' => $resume_skill_echo,
            'resume_picme' => $input2->resume_picme,
            'resume_summary' => $input2->resume_summary,
            'resume_display' => $input2->resume_display,
        ]);
        return redirect('/present/'.$resume_id.'/edit');
    }

    // 履歷清單管理
    public function resumeManageList (Request $request){
        $resume_id = session()->get('resume_id');
        $page = $request->page;
        $Resume_id = session()->put('page',$page);
        // dd($Resume_id);

        $hasDisplay = DB::table('presents')
        ->where('resume_display', 1)
        ->exists(); // 回傳 bool (true 或 false)
        
       // 每頁資料量
        $row_per_page = 10;
            
        $ResumePaginate  = DB::table('presents')
                    ->paginate($row_per_page);

        $presents_all = DB::table('presents')->get();

        $binging = [
            'title' => '履歷管理',
            'ResumePaginate' => $ResumePaginate,
            'resume_id' => $resume_id,
            'hasDisplay' => $hasDisplay,
            'presents_all' => $presents_all,
        ];
        return view('present.resumeManage', $binging);
    }

    public function resumeItemEdit($resume_id)  {
        $Resume_id = session()->put('resume_id', $resume_id);
        $page = session()->get('page');
        $presents = DB::table('presents')
                ->where('presents.resume_id','=',$resume_id)
                ->get();
        $presents_all = DB::table('presents')->get();
        
        
        $presents_six = DB::table('presents_sixes')->get();
        $presents_marry = DB::table('presents_marries')->get();
        $presents_skill_type = DB::table('presents_skill_types')->get();

        $resume_experience = $presents[0]->resume_experience;
        $resume_experience_decode = json_decode($resume_experience,true);

        $resume_skill = $presents[0]->resume_skill;
        $resume_skill_decode = json_decode($resume_skill,true);

        $resume_sideproject = $presents[0]->resume_sideproject;
        $resume_sideproject_decode = json_decode($resume_sideproject,true);
        //    dd($resume_sideproject_decode);     
                // $presents = DB::table('presents')
                //         ->where('presents.resume_display','=','1')
                //         ->get();
                $SitePaginate = DB::table('sites')
                        ->where('site_id','=','1')
                        ->get();
                        
        $binding = [
            'title' => '編輯履歷',
            'presents' => $presents,
            'presents_all' => $presents_all,
            'presents_sixes' => $presents_six,
            'presents_marries' => $presents_marry,
            'presents_skill_types' => $presents_skill_type,
            'resume_experience_decode' => $resume_experience_decode,
            'resume_skill_decode' => $resume_skill_decode,
            'resume_sideproject_decode' => $resume_sideproject_decode,
            'resume_id' => $resume_id,
            'page' => $page,
        ];

        if($SitePaginate[0]->site_maintain=='0'){
            return view('present.resumeEdit', $binding);
        }else{
            return view('site.managelist', $binging);
        }
    }

    public function testAjax(Request $request) {
        // 1. PHP 後端安全二次驗證（包含所有動態生成欄位）
        $validator = Validator::make($request->all(), [
            'avatar'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'resume_name' => 'required|string|max:255',
            'name'        => 'required|string|max:255',
            'gender'      => 'required|in:1,2,0',
            'age'         => 'required|integer|between:1,120',
            'marriage'    => 'required|in:1,2',
            'school'      => 'required|string|max:255',
            'phone'       => ['required', 'regex:/^09[0-9]{8}$/'],
            'email'       => 'required|email|max:255',
            'summary'     => 'required|string',
            'job_summary' => 'required|string',

            // 工作經歷欄位驗證
            'exp_time'    => 'required|array|min:1',
            'exp_time.*'  => 'required|string|max:255',
            'exp_company' => 'required|array|min:1',
            'exp_company.*'=> 'required|string|max:255',
            'exp_title'   => 'required|array|min:1',
            'exp_title.*' => 'required|string|max:255',

            // 專業技能欄位驗證
            'skill_category'   => 'required|array|min:1',
            'skill_category.*' => 'required|in:frontend,backend',
            'skill_name'       => 'required|array|min:1',
            'skill_name.*'     => 'required|string|max:255',
            'skill_level'      => 'required|array|min:1',
            'skill_level.*'    => 'required|integer|between:1,5',

            // 作品集欄位驗證 (對應前端新佈局順序)
            'portfolio_image'   => 'required|array|min:1',
            'portfolio_image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'portfolio_title'   => 'required|array|min:1',
            'portfolio_title.*' => 'required|string|max:255',
            'portfolio_link'    => 'required|array|min:1',
            'portfolio_link.*'  => 'required|url|max:255',
            'portfolio_desc'    => 'required|array|min:1',
            'portfolio_desc.*'  => 'required|string',
        ], [
            'avatar.required' => '個人頭像為必填項。',
            'phone.regex' => '手機號碼格式必須為合法的台灣手機 10 碼。',
            'exp_time.*.required' => '工作經歷的「在職時間」未填寫。',
            'exp_company.*.required' => '工作經歷的「公司名稱」未填寫。',
            'exp_title.*.required' => '工作經歷的「職稱」未填寫。',
            'skill_category.*.required' => '專業技能的「類別」未選取。',
            'skill_name.*.required' => '專業技能的「技能名稱」未填寫。',
            'skill_level.*.required' => '專業技能的「熟練度」未選取。',
            'portfolio_image.*.required' => '作品集的「作品縮圖」未上傳。',
            'portfolio_image.*.image' => '作品縮圖必須是正確的圖片格式。',
            'portfolio_title.*.required' => '作品集的「作品名稱」未填寫。',
            'portfolio_link.*.url' => '作品集的「作品連結」網址格式不正確。',
            'portfolio_desc.*.required' => '作品集的「作品說明」未填寫。'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. 儲存實體個人頭像圖片到 storage/app/public/avatars
        $avatarPath = $request->file('avatar')->store('avatars', 'public');


        // 3. 【核心需求】將「在職時間、公司、職稱」打包成工作經歷的 JSON 格式
        $experienceArray = [];
        
        foreach ($request->exp_time as $index => $time) {
            $experienceArray[] = [
                'ID' => $index+1,
                '在職時間'    => $time,
                '公司' => $request->exp_company[$index],
                '職稱'   => $request->exp_title[$index]
            ];
        }
        
        // 轉為標準 JSON 字串
        $experienceJson = json_encode($experienceArray, JSON_UNESCAPED_UNICODE);


        // 4. 【核心需求】將「類別、技能、熟練度」打包成專業技能的 JSON 格式
        $skillArray = [];
        
        foreach ($request->skill_name as $index => $name) {
            $skillArray[] = [
                'ID' => $index+1,
                'type' => $request->skill_category[$index],
                'skill'     => $name,
                'trained'    => (int)$request->skill_level[$index]
            ];
        }
        
        // 轉為標準 JSON 字串
        $skillJson = json_encode($skillArray, JSON_UNESCAPED_UNICODE);


        // 5. 【核心需求】將「作品名稱、作品連結、作品說明、作品縮圖」打包成作品集的 JSON 格式
        $portfolioArray = [];
        foreach ($request->portfolio_title as $index => $title) {
            $thumbPath = null;
            // 逐一處理並上傳對應的作品多張縮圖到 storage/app/public/portfolios
            if ($request->hasFile("portfolio_image.{$index}")) {
                $thumbPath = $request->file("portfolio_image.{$index}")->store('portfolios', 'public');
                // 產生不會重複的隨機檔名
                date_default_timezone_set('Asia/Taipei');
                $filename = 'images/present/'.date('Ymdhis') . '_' . pathinfo($request->file("portfolio_image.{$index}")->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $request->file("portfolio_image.{$index}")->getClientOriginalExtension();
                $targetPath = public_path('images/present');
                // 如果該資料夾不存在，自動建立它
                if (!File::isDirectory($targetPath)) {
                    File::makeDirectory($targetPath, 0777, true, true);
                }
                // 將檔案直接移動到 public/images/present 資料夾
                $request->file("portfolio_image.{$index}")->move($targetPath, $filename);
            }
        // // 2. 定義 public 底下的目標路徑：public/images/box
        // $targetPath = public_path('images/present');

        // // 如果該資料夾不存在，自動建立它
        // if (!File::isDirectory($targetPath)) {
        //     File::makeDirectory($targetPath, 0777, true, true);
        // }

        // $thumbPath = [];

        // // 3. 開始處理多圖上傳
        // if ($request->hasFile('portfolio_image.{$index}')) {
        //     foreach ($request->file('portfolio_image.{$index}') as $image) {
                
        //         // 產生不會重複的隨機檔名
        //         $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
        //         // 將檔案直接移動到 public/images/box 資料夾
        //         $image->move($targetPath, $filename);
                
        //         // 記錄存入的檔名或相對路徑（用於存入資料庫或前端顯示）
        //         $thumbPath[] = 'images/present/' . $filename;
        //     }
        //     // $thumbPath = json_encode($thumbPath, JSON_UNESCAPED_UNICODE);
        // }
        // // $thumbPath = json_encode($thumbPath, JSON_UNESCAPED_UNICODE);
            
            $portfolioArray[] = [
                'ID' => $index+1,
                '圖片名稱'       => $title,
                '連結'        => $request->portfolio_link[$index],
                '說明' => $request->portfolio_desc[$index],
                '路徑'   => $filename // 這裡存放上傳成功後的縮圖檔案路徑
            ];
            
        }
        // 轉為標準 JSON 字串
        $portfolioJson = json_encode($portfolioArray, JSON_UNESCAPED_UNICODE);

        if ($request->hasFile("avatar")) {
                $thumbPath = $request->file("avatar")->store('avatar', 'public');
                // 產生不會重複的隨機檔名
                date_default_timezone_set('Asia/Taipei');
                $filename = 'images/present/'.date('Ymdhis') . '_' . pathinfo($request->file("avatar")->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $request->file("portfolio_image.{$index}")->getClientOriginalExtension();
                $targetPath = public_path('images/present');
                // 如果該資料夾不存在，自動建立它
                if (!File::isDirectory($targetPath)) {
                    File::makeDirectory($targetPath, 0777, true, true);
                }
                // 將檔案直接移動到 public/images/present 資料夾
                $request->file("avatar")->move($targetPath, $filename);
            }
        // 3. 實體頭像儲存
        // // 原始檔名
        // // $fileName = $_FILES['avatar']['name'];
        // // 有上傳圖片
        // $pic = $request->file('avatar');
        // // 取出原始檔名的檔案名稱
        // $name = pathinfo($pic->getClientOriginalName(), PATHINFO_FILENAME);
        // // 檔案副檔名
        // $file_extension = $pic->getClientOriginalExtension();
        // // 產生自訂隨機檔案名稱
        // $file_name = $name . '-' . date('Y'.'m'.'d'.'H'.'i'.'s') . '.' . $file_extension;
        // // 檔案相對路徑
        // $avatarPath = 'images/present/' . $file_name;
        // // 檔案存放目錄為對外公開public目錄下的相對位置
        // $file_path = public_path($avatarPath);
        // // 裁切圖片
        // $image = Image::make($pic)->save($file_path);
        
        // $avatarPath = $request->file('avatar')->public_path('present', 'images');
        $uploadedPortfolioPaths = []; // 用於失敗時回滾清理

        // 4. 利用資料庫 Transaction（交易）安全儲存資料
        DB::beginTransaction();
        try {
            // 儲存主表資料並取得產生的 ID
            $resumeId = DB::table('presents')->insertGetId([
                'resume_name'   => $request->resume_name,
                'resume_nickname'           => $request->name,
                'resume_sex'         => $request->gender,
                'resume_age'            => $request->age,
                'resume_marry' => $request->marriage,
                'resume_education'         => $request->school,
                'resume_cellphone'          => $request->phone,
                'resume_email'          => $request->email,
                'resume_summary'            => $request->summary,
                'resume_introduction'  => $request->job_summary,
                'resume_picme'    => $avatarPath,
                'resume_experience'    => $experienceJson,
                'resume_skill'    => $skillJson,
                'resume_sideproject'  => $portfolioJson,
                'resume_display'  => $request->resume_display,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            

            DB::commit();
            return response()->json(['message' => '履歷資料已儲存成功']);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // 萬一資料庫中途斷線或儲存失敗，立刻自動清除剛才上傳的實體圖片，保持伺服器乾淨
            if ($avatarPath) {
                Storage::disk('public')->delete($avatarPath);
            }

            return response()->json([
                'errors' => ['system' => ['伺服器儲存失敗，錯誤回報：' . $e->getMessage()]]
            ], 500);
        }

        // 6. 執行資料庫儲存
        // 您可以將 $experienceJson, $skillJson, $portfolioJson 直接寫入您 Resume 模型的對應文字或 JSON 欄位中。
        // Resume::create([
        //     'avatar' => $avatarPath,
        //     'resume_name' => $request->resume_name,
        //     ...
        //     'experiences' => $experienceJson,
        //     'skills' => $skillJson,
        //     'portfolios' => $portfolioJson,
        // ]);

        // return response()->json([
        //     'success' => true, 
        //     'message' => '履歷資料已成功儲存！',
        //     'data_preview' => [
        //         'experiences_json' => $experienceJson,
        //         'skills_json'      => $skillJson,
        //         'portfolios_json'  => $portfolioJson
        //     ]
        // ]);
    }
    public function testAjax2(Request $request) {
        $resume_id = session()->get('resume_id');
        $Resume_id_put = session()->put('resume_id', $resume_id);
        // 1. PHP 後端安全二次驗證（包含所有動態生成欄位）
        $validator = Validator::make($request->all(), [
            'avatar'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'resume_name' => 'required|string|max:255',
            'name'        => 'required|string|max:255',
            'gender'      => 'required|in:1,2,0',
            'age'         => 'required|integer|between:1,120',
            'marriage'    => 'required|in:1,2',
            'school'      => 'required|string|max:255',
            'phone'       => ['required', 'regex:/^09[0-9]{8}$/'],
            'email'       => 'required|email|max:255',
            'summary'     => 'required|string',
            'job_summary' => 'required|string',

            // 工作經歷欄位驗證
            'exp_time'    => 'required|array|min:1',
            'exp_time.*'  => 'required|string|max:255',
            'exp_company' => 'required|array|min:1',
            'exp_company.*'=> 'required|string|max:255',
            'exp_title'   => 'required|array|min:1',
            'exp_title.*' => 'required|string|max:255',

            // 專業技能欄位驗證
            'skill_category'   => 'required|array|min:1',
            'skill_category.*' => 'required|in:frontend,backend',
            'skill_name'       => 'required|array|min:1',
            'skill_name.*'     => 'required|string|max:255',
            'skill_level'      => 'required|array|min:1',
            'skill_level.*'    => 'required|integer|between:1,5',

            // 作品集欄位驗證 (對應前端新佈局順序)
            'portfolio_image'   => 'required|array|min:1',
            'portfolio_image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'portfolio_title'   => 'required|array|min:1',
            'portfolio_title.*' => 'required|string|max:255',
            'portfolio_link'    => 'required|array|min:1',
            'portfolio_link.*'  => 'required|url|max:255',
            'portfolio_desc'    => 'required|array|min:1',
            'portfolio_desc.*'  => 'required|string',
        ], [
            'avatar.required' => '個人頭像為必填項。',
            'phone.regex' => '手機號碼格式必須為合法的台灣手機 10 碼。',
            'exp_time.*.required' => '工作經歷的「在職時間」未填寫。',
            'exp_company.*.required' => '工作經歷的「公司名稱」未填寫。',
            'exp_title.*.required' => '工作經歷的「職稱」未填寫。',
            'skill_category.*.required' => '專業技能的「類別」未選取。',
            'skill_name.*.required' => '專業技能的「技能名稱」未填寫。',
            'skill_level.*.required' => '專業技能的「熟練度」未選取。',
            'portfolio_image.*.required' => '作品集的「作品縮圖」未上傳。',
            'portfolio_image.*.image' => '作品縮圖必須是正確的圖片格式。',
            'portfolio_title.*.required' => '作品集的「作品名稱」未填寫。',
            'portfolio_link.*.url' => '作品集的「作品連結」網址格式不正確。',
            'portfolio_desc.*.required' => '作品集的「作品說明」未填寫。'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. 儲存實體個人頭像圖片到 storage/app/public/avatars
        $avatarPath = $request->file('avatar')->store('avatars', 'public');


        // 3. 【核心需求】將「在職時間、公司、職稱」打包成工作經歷的 JSON 格式
        $experienceArray = [];
        
        foreach ($request->exp_time as $index => $time) {
            $experienceArray[] = [
                'ID' => $index+1,
                '在職時間'    => $time,
                '公司' => $request->exp_company[$index],
                '職稱'   => $request->exp_title[$index]
            ];
        }
        
        // 轉為標準 JSON 字串
        $experienceJson = json_encode($experienceArray, JSON_UNESCAPED_UNICODE);


        // 4. 【核心需求】將「類別、技能、熟練度」打包成專業技能的 JSON 格式
        $skillArray = [];
        
        foreach ($request->skill_name as $index => $name) {
            $skillArray[] = [
                'ID' => $index+1,
                'type' => $request->skill_category[$index],
                'skill'     => $name,
                'trained'    => (int)$request->skill_level[$index]
            ];
        }
        
        // 轉為標準 JSON 字串
        $skillJson = json_encode($skillArray, JSON_UNESCAPED_UNICODE);


        // 5. 【核心需求】將「作品名稱、作品連結、作品說明、作品縮圖」打包成作品集的 JSON 格式
        $portfolioArray = [];
        foreach ($request->portfolio_title as $index => $title) {
            $thumbPath = null;
            // 逐一處理並上傳對應的作品多張縮圖到 storage/app/public/portfolios
            if ($request->hasFile("portfolio_image.{$index}")) {
                $thumbPath = $request->file("portfolio_image.{$index}")->store('portfolios', 'public');
                // 產生不會重複的隨機檔名
                date_default_timezone_set('Asia/Taipei');
                $file = $request->file("portfolio_image.{$index}");
    
                //  先把變數定義好（例如用原本的檔名，或者用時間戳記重新命名）
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension()?: 'jpg';
                $destination = 'images/present/'.date('Ymdhis') . '_' . $filename . '.' . $extension;
                $targetPath = public_path('images/present');
                // 如果該資料夾不存在，自動建立它
                if (!File::isDirectory($targetPath)) {
                    File::makeDirectory($targetPath, 0777, true, true);
                }
                // 將檔案直接移動到 public/images/present 資料夾
                $file->move($targetPath, $destination);
            }
        // // 2. 定義 public 底下的目標路徑：public/images/box
        // $targetPath = public_path('images/present');

        // // 如果該資料夾不存在，自動建立它
        // if (!File::isDirectory($targetPath)) {
        //     File::makeDirectory($targetPath, 0777, true, true);
        // }

        // $thumbPath = [];

        // // 3. 開始處理多圖上傳
        // if ($request->hasFile('portfolio_image.{$index}')) {
        //     foreach ($request->file('portfolio_image.{$index}') as $image) {
                
        //         // 產生不會重複的隨機檔名
        //         $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
        //         // 將檔案直接移動到 public/images/box 資料夾
        //         $image->move($targetPath, $filename);
                
        //         // 記錄存入的檔名或相對路徑（用於存入資料庫或前端顯示）
        //         $thumbPath[] = 'images/present/' . $filename;
        //     }
        //     // $thumbPath = json_encode($thumbPath, JSON_UNESCAPED_UNICODE);
        // }
        // // $thumbPath = json_encode($thumbPath, JSON_UNESCAPED_UNICODE);
            
            $portfolioArray[] = [
                'ID' => $index+1,
                '圖片名稱'       => $title,
                '連結'        => $request->portfolio_link[$index],
                '說明' => $request->portfolio_desc[$index],
                '路徑'   => $destination // 這裡存放上傳成功後的縮圖檔案路徑
            ];
            
        }
        // 轉為標準 JSON 字串
        $portfolioJson = json_encode($portfolioArray, JSON_UNESCAPED_UNICODE);

        if ($request->hasFile("avatar")) {
            // 3. 實體頭像儲存
            // 原始檔名
            // $fileName = $_FILES['avatar']['name'];
            // 有上傳圖片
            $pic = $request->file('avatar');
            // 取出原始檔名的檔案名稱
            $name = pathinfo($pic->getClientOriginalName(), PATHINFO_FILENAME);

            // 【新增這行】如果原始檔名最前面有類似 20260720105424_ 的數字底線組合，自動把它移除
            $name = preg_replace('/^\d{8,14}_/', '', $name);
            
            // 檔案副檔名
            $file_extension = $pic->getClientOriginalExtension()?: 'jpg';
            // 產生自訂隨機檔案名稱
            $avatarPath = 'images/present/'.date('Ymdhis') . '_' . $name . '.' . $file_extension;
            // $file_name = $name . '-' . date('Y'.'m'.'d'.'H'.'i'.'s') . '.' . $file_extension;
            // 檔案相對路徑
            // $avatarPath = 'images/present/' . $file_name;
            // 檔案存放目錄為對外公開public目錄下的相對位置
            $file_path = public_path($avatarPath);
            // 裁切圖片
            $image = Image::make($pic)->save($file_path);
        }
        
        // $avatarPath = $request->file('avatar')->public_path('present', 'images');
        $uploadedPortfolioPaths = []; // 用於失敗時回滾清理

        if($request->resume_display=='1'){
            present::where('resume_display', '1')
            ->update(['resume_display' => '0']);
        }
        
        
        // 4. 利用資料庫 Transaction（交易）安全儲存資料
        DB::beginTransaction();
        try {
            // 儲存主表資料並取得產生的 ID
            $present = present::find($resume_id);
            $present->update([
                'resume_name'   => $request->resume_name,
                'resume_nickname'           => $request->name,
                'resume_sex'         => $request->gender,
                'resume_age'            => $request->age,
                'resume_marry' => $request->marriage,
                'resume_education'         => $request->school,
                'resume_cellphone'          => $request->phone,
                'resume_email'          => $request->email,
                'resume_summary'            => $request->summary,
                'resume_introduction'  => $request->job_summary,
                'resume_picme'    => $avatarPath,
                'resume_experience'    => $experienceJson,
                'resume_skill'    => $skillJson,
                'resume_sideproject'  => $portfolioJson,
                'resume_display'  => $request->resume_display,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            

            DB::commit();
            return response()->json(['message' => '履歷資料已儲存成功']);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // 萬一資料庫中途斷線或儲存失敗，立刻自動清除剛才上傳的實體圖片，保持伺服器乾淨
            if ($avatarPath) {
                Storage::disk('public')->delete($avatarPath);
            }

            return response()->json([
                'errors' => ['system' => ['伺服器儲存失敗，錯誤回報：' . $e->getMessage()]]
            ], 500);
        }

        // 6. 執行資料庫儲存
        // 您可以將 $experienceJson, $skillJson, $portfolioJson 直接寫入您 Resume 模型的對應文字或 JSON 欄位中。
        // Resume::create([
        //     'avatar' => $avatarPath,
        //     'resume_name' => $request->resume_name,
        //     ...
        //     'experiences' => $experienceJson,
        //     'skills' => $skillJson,
        //     'portfolios' => $portfolioJson,
        // ]);

        // return response()->json([
        //     'success' => true, 
        //     'message' => '履歷資料已成功儲存！',
        //     'data_preview' => [
        //         'experiences_json' => $experienceJson,
        //         'skills_json'      => $skillJson,
        //         'portfolios_json'  => $portfolioJson
        //     ]
        // ]);
    }

    public function toggleStatus(Request $request) {
        // 1. 驗證前端傳過來的資料是否合法
        $request->validate([
            'id' => 'required|integer',
            'resume_display' => 'required|in:0,1', // 狀態必須是 0 或 1
        ]);

        present::where('resume_display', '1')
        ->update(['resume_display' => '0']);
        // 2. 尋找對應的資料
        $present = present::find($request->id);
        
        if ($present) {
            // 3. 修改欄位並儲存 (Laravel 會自動把 0/1 轉為 boolean 寫入 tinyint 欄位)
            $present->update([
                'resume_display'  => $request->resume_display,
            ]);

            // 4. 回傳 JSON 成功訊息
            return response()->json(['success' => true, 'message' => '狀態更新成功！']);
        }

        // 找不到資料時回傳 404
        return response()->json(['success' => false, 'message' => '找不到該筆設定。'], 404);
    }

    public function resumeChangeResumeDisplay(Request $request,$id) {
        $page = session()->get('page');
        $resume_id_put = session()->put('resume_id',$id);
        $resume_display = $request->resume_display;
        present::where('resume_display', '1')
    ->update(['resume_display' => '0']);
        present::where('resume_id', $id)
    ->update(['resume_display' => '1']);
        // $resume = presents::find($id);
        // $resume->update([
        //     'resume_display' => $resume_display,
        // ]);
        $pre=DB::table('presents')->get();
        $currentUrl = url()->previous();
        return redirect('/present/manage?page=' . $page);
    }
}
