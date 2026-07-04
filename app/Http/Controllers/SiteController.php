<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\site;;

class SiteController extends Controller
{
     /**if($SitePaginate[0]->site_maintain=='0'){
            return view('front.classItem', $binging);
        }else{
            return view('site.managelist', $binging);
        }   
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //網站檢視管理
    public function siteManageList(){
        $siteAllPaginate = DB::table('sites')
                            ->get();
        $sitePaginate = DB::table('sites')
                            ->where('site_display','=','1')
                            ->get();
        $site_id = $sitePaginate[0]->site_id;
        $Site_id = session()->put('site_id',$site_id);

        $binding = [
            'title' => '網站管理',
            'site' => $sitePaginate,
            'site_all' => $siteAllPaginate,
            'site_id' => $site_id,
        ];

        return view('site.managelist2', $binding);
    }

    // 更新目前顯示網站
    public function siteChgViewDis(Request $request){
        // dd($request->site_chgdis_id);
        $site = site::find($request->site_chgdis_id);
        if($site->site_display=='0'){
            $site->update([
                'site_display' => 1,
            ]);
        }
        $site_no_select = DB::table('sites')
            ->where('sites.site_id','!=',$site->site_id)
            ->get();
        
        foreach ($site_no_select as $sites){
            $site_no_select_id = $sites->site_id;
            $site = site::find($site_no_select_id);
            
            $site->update([
                'site_display' => 0,
            ]);
        }

        $SitePaginate = DB::table('sites')->get();

        $binging = [
            'site' => $SitePaginate,
    	];

        if($SitePaginate[0]->site_maintain=='0'){
            return redirect('/site/manage');
        }else{
            return view('site.managelist', $binging);
        }   
        
    }

    // 更新網站例行性維護狀態
    public function siteChgMainDis(Request $request){
        $site_id = session()->get('site_id');
        $site = site::find($site_id);
        if($site->site_maintain == '1'){
            $site_maintain = '0'; 
        }else{
            $site_maintain = '1'; 
        }
        $site->update([
            'site_maintain' => $site_maintain,
        ]);
        $sitePaginate = DB::table('sites')->get(); 
        // $site = site::OrderBy('site_id', 'asc')->get();
        $binding = [
            'title' => '登入',
            'site' => $sitePaginate,
        ];
        $currentUrl = url()->previous();
        return redirect($currentUrl);
    }

    // 更新網站維護說明
    public function siteChgMainDes (Request $request){
        $site_id = session()->get('site_id');
        $site = site::find($site_id);
        if($site->site_id=='1'){
            $site->update([
                'site_maintain_caption' => $request->site_maintain_caption,
                'site_title' => $request->site_title,
                'site_description' => $request->site_description,
                'site_name_en' => $request->site_name_en,
                'site_lineid' => $request->site_lineid,
                'site_wechartid' => $request->site_wechartid,
                'site_cellphone' => $request->site_cellphone,
                'site_address' => $request->site_address,
            ]);
        }else{
            $site->update([
                'site_maintain_caption' => $request->site_maintain_caption,
            ]);
        }
        
        $sitePaginate = DB::table('sites')->get(); 
        // $site = site::OrderBy('site_id', 'asc')->get();
        $binding = [
            'title' => '登入',
            'site' => $sitePaginate,
        ];
        return redirect('/site/manage');
    }
}
