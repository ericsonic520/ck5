<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\present;
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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
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
                        ->where('site_id','=','1')
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
            'title' => '新增履歷',
            'back' => '<-',
        ];
        return view('present.resumeAdd', $binding);
    }

    // 履歷表新增處理
    public function resumeAddIdDeal(Request $request) {

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

        if (isset($input['resume_picme'])) {
            // 原始檔名
            $fileName = $_FILES['resume_picme']['name'];
            // 取出原始檔名的檔案名稱
            $name = pathinfo($fileName, PATHINFO_FILENAME);
            // 有上傳圖片
            $pic = $input['resume_picme'];
            // 檔案副檔名
            $file_extension = $pic->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = $name . '-' . date('Y'.'m'.'d'.'H'.'i'.'s') . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/class/' . $file_name;
            // 檔案存放目錄為對外公開public目錄下的相對位置
            $file_path = public_path($file_relative_path);
            // 裁切圖片
            $image = Image::make($pic)->save($file_path);
            // 設定圖片檔案相對路徑
            $input['resume_picme'] = $file_relative_path;
        }    dd($input['resume_picme']);

        present::create([
                    'resume_name' => $input2->resume_name,
                    'resume_nickname' => $input2->resume_nickname,
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
    public function resumeManageList (){
       // 每頁資料量
        $row_per_page = 10;
            
        $ResumePaginate  = DB::table('presents')
                    ->paginate($row_per_page);
        $binging = [
            'title' => '履歷管理',
            'ResumePaginate' => $ResumePaginate,
        ];
        return view('present.resumeManage', $binging);
    }

    public function resumeItemEdit($resume_id)  {
        $Resume_id = session()->put('resume_id', $resume_id);
        $presents = DB::table('presents')
                ->where('presents.resume_id','=',$resume_id)
                ->get();

        $resume_experience = $presents[0]->resume_experience;
        $resume_experience_decode = json_decode($resume_experience,true);

        $resume_skill = $presents[0]->resume_skill;
        $resume_skill_decode = json_decode($resume_skill,true);
                
                // $presents = DB::table('presents')
                //         ->where('presents.resume_display','=','1')
                //         ->get();
                $SitePaginate = DB::table('sites')
                        ->where('site_id','=','1')
                        ->get();
                        
        $binding = [
            'title' => '編輯履歷',
            'presents' => $presents,
            'resume_experience_decode' => $resume_experience_decode,
            'resume_skill_decode' => $resume_skill_decode,
            'resume_id' => $resume_id,
        ];

        if($SitePaginate[0]->site_maintain=='0'){
            return view('present.resumeEdit', $binding);
        }else{
            return view('site.managelist', $binging);
        }
    }

    
}
