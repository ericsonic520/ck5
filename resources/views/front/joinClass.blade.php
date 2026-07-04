@extends('front.master')
@section('content')
    <!-- <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css') }}"> -->
   
    <div class="container">
        <div class="col-md-12">

            {{-- 錯誤訊息模板元件 --}}
            @include('components.validationErrorMessage')
            <label>
                <h1>{{ $title }}</h1>
            </label>

            <table>
                
                
                
                <tr>
                    <td colspan="2">
                        <form action="/class/joind" method="post">
                           {{-- 隱藏方法欄位 --}}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label>姓名:</label>
                                @if(empty(Auth::user()->id))
                                    <input type="text" class="form-control" name="nickname" placeholder="姓名" value="" Readonly="true">
                                @else
                                    <input type="text" class="form-control" name="nickname" placeholder="姓名" value="">
                                @endif
                            </div>
                            

                            <div class="form-group">
                                <label>生日:</label>
                                @if(empty(Auth::user()->id))
                                    <input type="date" class="form-control" name="birth" placeholder="生日" value="" Readonly="true">
                                @else
                                    <input type="date" class="form-control" name="birth" placeholder="生日" value="">
                                @endif
                            </div>

                            <div class="form-group">
                                <label>手機:</label>
                                @if(empty(Auth::user()->id))
                                    <input type="text" class="form-control" name="phone" placeholder="手機" value="" Readonly="true">
                                @else
                                    <input type="text" class="form-control" name="phone" placeholder="手機" value="">
                                @endif
                            </div>

                            <div class="form-group">
                                <label>地址:</label>
                                @if(empty(Auth::user()->id))
                                    <input type="text" class="form-control" name="city" placeholder="地址" value="" Readonly="true">
                                @else
                                    <input type="text" class="form-control" name="city" placeholder="地址" value="">
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                @if(empty(Auth::user()->id))
                                    <input type="text" class="form-control" name="email" placeholder="Email" value="" Readonly="true">
                                @else
                                    <input type="text" class="form-control" name="email" placeholder="Email" value="">
                                @endif
                            </div>

                            <input type="hidden" class="form-control" name="class_id" value="{{ $Course_id }}">
                            <!-- <input type="hidden" class="form-control" name="user_id" value=""> -->
                            <!-- 選購課程一節 -->
                            <!-- <input type="hidden" name="quota" id="quota" value=""> -->
                            <!-- <input type="hidden" name="quota_last" id="quota_last" value=""> -->
                            @if(empty(Auth::user()->id))
                            <a href="/login"><button type="button" class="btn">
                                登入後即可預約
                            </button></a>
                            @else
                            <button type="submit" class="btn">
                                選課程
                            </button>
                            @endif
                            <a href="/">
                                <button type="button" class="btn">
                                    回首頁
                                </button>
                            </a> 
                            {{-- CSRF 欄位 --}}
                            {{ csrf_field() }}
                        </form>
                                             
                    </td>
                </tr>
            </table>

        </div>
    </div>
@endsection