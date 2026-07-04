<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Socialite;
use Validator;
use Hash;
use DB;
use App\Jobs\SendSignUpMailJob;
use App\Models\User;
use Auth;

class UserController extends Controller
{
  // 會員列表
  public function userList()
  {
      // 每頁資料量
      $row_per_page = 10;
      if(Auth::user()->type=='A'){
        // 撈取會員分頁資料
        $UserPaginate = User::OrderBy('id', 'asc')
            ->paginate($row_per_page);

        $binding = [
            'title' => '會員列表',
            'UserPaginate' => $UserPaginate,
        ];
      }elseif(Auth::user()->type=='G'){
        // 撈取會員分頁資料
        $UserPaginate = User::OrderBy('id', 'asc')->where('name',Auth::user()->name)
            ->paginate($row_per_page);

        $binding = [
            'title' => '會員列表',
            'UserPaginate' => $UserPaginate,
        ];
      }

      return view('auth.userList', $binding);
  }

  public function memberUp ($user_id)
  {
    $User = User::findOrFail($user_id);
    if (Auth::user()->type=='A') {
      $binding = [
        'title' => '修改人員',
        'User' => $User,
      ];
    }else{
      $binding = [
        'title' => '修改資料',
        'User' => $User,
      ];
    }

    return view('auth.memberUp', $binding);
  }

  public function memberUpDeal($user_id)
  {
    $User = User::findOrFail($user_id);
    $input = request()->all();
    
    $rules = [
      'nickname' => [
        /*'required',*/
        'max:10',
      ],
      'email' => [
        'required',
        'max:150',
        'email',
      ],
      'password' => [
        'required',
        'min:6'
      ],
      'category' => [
        'in:A,G'
      ],
    ];

    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
      return redirect('/user/auth/' . $User->id . '/edit')
          ->withErrors($validator)
          ->withInput();
    }

    $input['password'] = Hash::make($input['password']);

    $User->update($input);

    return redirect('/user/auth/' . $User->id . '/edit');
  }

  public function memberItemDel($user_id)
  {
    $User = User::findOrFail($user_id);
    if ($User !=null) {
      $User->delete();
      return redirect('/user');
    }
  }

  

  // 處理登出資料
  public function signOut(){
      // 清除 Session
      session()->forget('user_id');
      
      // 重新導向回首頁
      return redirect('/user/auth/login');
  }
}

