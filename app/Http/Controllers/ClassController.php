<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\pluss;
use App\Models\user;
use App\Exports\CourseExport;
use App\Exports\CourseExportAll;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Image;
use Validator;
use Auth;
use ECPay_AllInOne;
use ECPay_PaymentMethod;

class ClassController extends Controller
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
    public function classIndex()
    {
        // 重新導向至課程頁
        return redirect('login');
    }

    // 新增課程
    public function classAddId(){
        $binding = [
            'title' => '新增課程',
        ];
        return view('class.classAdd', $binding);
    }

    // 處理新增課程
    public function classAddIdDeal(){
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [
            // 課程類別
            'category' => [
                'required',
                'in:E,M,C'
            ],
            // 課程名稱
            'name' => [
                'required',
                'max:80',
            ],
            // 課程圖片
            'pic' => [
                'file',         
                'image',       
                'max: 10240',   
            ],
            // 課程日期
            'class_date' => [
                'required',
            ],
            // 課程開始時間
            'class_start_time' => [
                'required',
            ],
            // 課程結束時間
            'class_end_time' => [
                'required',
                'after:class_start_time',
            ],
            // 名額
            'quota' => [
                'required',
                'integer',
                'min: 1',   
            ],
            // 課程狀態
            'status' => [
                'required',
                'in:R,P'
            ],
            // 課程內容
            'content' => [
                'max: 150',
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/class/add')      
                ->withErrors($validator)
                ->withInput();
        }

        if (isset($input['pic'])) {
            // 有上傳圖片
            $pic = $input['pic'];
            // 檔案副檔名
            $file_extension = $pic->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = uniqid() . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/class/' . $file_name;
            // 檔案存放目錄為對外公開public目錄下的相對位置
            $file_path = public_path($file_relative_path);
            // 裁切圖片
            $image = Image::make($pic)->fit(250,100)->save($file_path);
            // 設定圖片檔案相對路徑
            $input['pic'] = $file_relative_path;
        }   

        // 課程資料更新
        $Course = course::create($input);

        // 重新導向到課程編輯頁
        return redirect('/class/manage/');
    }

    // 課程編輯頁
    public function classItemEdit($course_id)
    {
        // 撈取課程資料
        $Course = course::findOrFail($course_id);

        if (!is_null($Course->pic)) {
            $Course->pic = url($Course->pic);
        }

        $binding = [
            'title' => '編輯課程',
            'Course' => $Course,
        ];

        return view('class.classEdit', $binding);
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

    // 課程資料更新處理
    public function classItemRenewDeal($course_id){
        // 撈取課程資料
        $Course = course::findOrFail($course_id);
        // 接收輸入資料
        $input = request()->all();
        $input['class_start_time']=substr($input['class_start_time'],0,5);
        $input['class_end_time']=substr($input['class_end_time'],0,5);
        $input['class_date']=str_replace("-","/",$input['class_date']);
        // 驗證規則
        $rules = [
            // 課程類別
            'category' => [
                'required',
                'in:E,M,C'
            ],
            // 課程名稱
            'name' => [
                'required',
                'max:80',
            ],
            // 課程圖片
            'pic' => [
                'file',         
                'image',        
                'max: 10240',   
            ],
            // 課程日期
            'class_date' => [
                'required',
                'date',
            ],
            // 課程開始時間
            'class_start_time' => [
                'required',
            ],
            // 課程結束時間
            'class_end_time' => [
                'required',
            ],
            // 名額
            'quota' => [
                'required',
                'integer',
                'min: 1',  
            ],
            // 課程狀態
            'status' => [
                'required',
                'in:R,P'
            ],
            // 課程內容
            'content' => [
                'max: 150',
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/class/' . $Course->id . '/edit')      
                ->withErrors($validator)
                ->withInput();
        }

        if (isset($input['pic'])) {
            // 有上傳圖片
            $pic = $input['pic'];
            // 檔案副檔名
            $file_extension = $pic->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = uniqid() . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/class/' . $file_name;
            // 檔案存放目錄為對外公開public目錄下的相對位置
            $file_path = public_path($file_relative_path);
            // 裁切圖片
            $image = Image::make($pic)->fit(250,100)->save($file_path);
            // 設定圖片檔案相對路徑
            $input['pic'] = $file_relative_path;
        }

        $Course->address = $Course->county . '' . $Course->district . '' . $Course->zipcode;

        // 課程資料更新
        $Course->update($input);

        // 重新導向到課程編輯頁
        return redirect('/class/' . $Course->id . '/edit');
    }

    // 課程管理清單檢視
    public function classManageList()
    {
        $Course_id=session()->get('class_id');

        // 每頁資料量
        $row_per_page = 10;
        // 撈取課程分頁資料
        $CoursePaginate = course::OrderBy('id', 'asc')
            ->paginate($row_per_page);

        foreach ($CoursePaginate as $key=>$Course) {
            if (!is_null($Course->pic)) {
                // 設定課程照片網址
                $Course->pic = url($Course->pic);
            }
            $count=count(DB::table('pluss')->where("class_id","=",$Course_id)->get());
            $Course->qty=$Course->quota_last-$count;
        }
        

        if(Auth::user()->type=='G'){
            $binging = [
                'title' => '我的課程',
                'CoursePaginate' => $CoursePaginate,
            ];
        }else{
            $binging = [
                'title' => '管理課程',
                'CoursePaginate' => $CoursePaginate,
            ];
        }

        return view('class.classManage', $binging);
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

    // 課程清單檢視
    public function classList()
    {  
        // 每頁資料量
        $row_per_page = 10;
        // 撈取商品分頁資料
        $CoursePaginate = course::OrderBy('id', 'asc')
            ->where('status', 'P')
            ->paginate($row_per_page);


        // 設定課程圖片網址
        foreach ($CoursePaginate as &$Course) {
            if (!is_null($Course->pic)) {
                // 設定課程照片網址
                $Course->pic = url($Course->pic);
            }
        }

        $binding = [
            'title' => '課程列表',
            'CoursePaginate' => $CoursePaginate,
        ];

        return view('class.classList', $binding);
    }

    public function classItemDel($course_id)
    {
        $course =course::where('id',$course_id)->first();

    if ($course != null) {
        $course->delete();
        return redirect('/class/manage');
    }

    return redirect('/class/manage');
    }

    // 前台課程內容
     public function classItem($course_id)
    {
        $Course = course::findOrFail($course_id);
        if (!is_null($Course->pic)) {
            $Course->pic = url($Course->pic);
        } 
        session()->put('class_id', $Course->id);
        $user_id = session()->get('user_id');
        $binging = [
            'title' => '課程內容',
            'Course' => $Course,
        ];
        return view('front.showClassItem', $binging);
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