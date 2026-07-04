@extends('front.masterInside')
@section('title',$site_title)
@section('description',$site_description)
@section('content')
<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{border-top:0px solid #ddd;}
    .table>tbody>tr:nth-child(1)>td{padding: 5px;border-bottom: 1px #777 dotted;font-size: 18px;font-weight: bold;}
    .artivceTitle h3{margin: 0;padding: 0 0 8px 50px;border: 0;float: left;font-size: 18px;font-weight: bold;color: #2d2d2d;}
    .artivceTitle span {margin: 0 0 0 5px;padding: 5px 0 0 5px;float: left;border-left: 1px #bbb solid;font-size: 12px;}
    .date {margin: 0;padding: 10px 0 0;font-size: 12px;text-align: right;}
    .bg {top: 0;left: 0;bottom: 0;right: 0;z-index: -999;}
    .bg img {min-height: 100%;width: 100%;}
    .nav>ul>li {float:left;margin-left: 25px;}
    .navBar{float:right;}
    .topNav{float:right;}
    .Breadcrumbs>li{background-color: #f5bdbd;list-style-type:none;padding:4px;margin-left:0px !important;}
    .Breadcrumbs>li:hover{    background-color: #f5bdbd;list-style-type: none;padding: 10px;margin-left: 0px !important;margin-top: -12px;}
    .Breadcrumbs>li>a>div:nth-child(1){color: white;padding: 0px 0px 0px 4px;font-size: 8px;font-weight: bold;border-left: 4px #fff solid;} 
    .Breadcrumbs>li>a>div:nth-child(2){color: white;padding: 0px 0px 0px 4px;font-size: 15px;border-left: 4px #fff solid;}
</style>
    <div class="container">
        <div class="topNav">	
            <div class="nav">
            <h3>網站主選單</h3>
            <ul class="Breadcrumbs">
                @foreach($breadcrumbs as $breadcrumb)
                <li><a href="{{ $breadcrumb->breadcrumb_api }}"><div>{{ $breadcrumb->breadcrumb_name_en }}</div><div>{{ $breadcrumb->breadcrumb_name }}</div></a></li>
                @endforeach
            </ul>
            </div>
        </div>
        <div class="bg"><img src="/images/news/lake.png" alt="lake.png"></div>
        <div class="col-md-12">
            @include('front.inside.side')
            <div class="col-md-9" style="float:right;">
                {{-- 錯誤訊息模板元件 --}}
                @include('components.validationErrorMessage')
                <label style="float:right">
                    <div>首頁 > {{ $menu_name }}</div>
                </label>
                <div class="artivceTitle">
                    <h3>{{ $menu_name }}</h3>
                    <span>{{ $menu_caption }}</span>
                </div>
                <table class="table">
                    <tr><td>{{ $menu_name }}</td></tr>
                    <tr><td class="date">{{substr($menu_post_time,0,-8)}}</td></tr>
                    <tr><td style="color: #e91c1c;font-size: 26px;text-align: center;">{!! htmlspecialchars_decode($menu_description) !!}</td></tr>
                    <!-- <tr>
                        <td colspan="2">
                            <form action="/class/join" method="get">
                                <input type="hidden" name="menu_id" value="{{ $menus[0]->menu_id }}">
                                <button type="submit" class="btn">
                                    選課程
                                </button>
                                <a href="/">
                                    <button type="button" class="btn" >
                                        回上頁
                                    </button>
                                </a>  
                            
                            </form>
                                                
                        </td>
                    </tr> -->
                </table>
            </div>
        </div>
    </div>
@endsection
 