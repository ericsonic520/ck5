@extends('front.masterInside')
@section('title',$site_title)
@section('description',$site_description)
@section('content')
<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{border-top:0px solid #ddd;}
    .table>tbody{text-align:center;}
    /* .table>tbody>tr:nth-child(4)>td{text-align:center;}  */
    .table>tbody>tr:nth-child(4)>td:nth-child(1){width: 200px;}
    .table>tbody>tr:nth-child(4)>.des{width: 400px;float:left;}
    .dateo{margin: 0 0 10px;padding: 5px 0;background: #a8a8a8;overflow: hidden;text-align: center;border-top: 2px solid #000;color: white;}
    .date1{border-right: 1px #fff dotted; color:#fff;width:200px;}
    .des_lef{float:left;}
    .title{width:400px;}
    .artivceTitle h3{margin: 0;padding: 0 0 8px 50px;border: 0;float: left;font-size: 18px;font-weight: bold;color: #2d2d2d;}
    .artivceTitle span {margin: 0 0 0 5px;padding: 5px 0 0 5px;float: left;border-left: 1px #bbb solid;font-size: 12px;}
    .date {margin: 0;padding: 10px 0 0;font-size: 12px;text-align: right;}
    .bg {top: 0;left: 0;bottom: 0;right: 0;z-index: -999;}
    .bg img {min-height: 100%;width: 100%;}
    .nav>ul>li {float:left;margin-left: 25px;}
    .navBar{float:right;}
    .topNav{float:right;}
    .share_title{color: gray;text-decoration: none;}
    .post_down{border-bottom:1px solid #ddd;}
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
                    <div>首頁 > {{ $sort_name }}</div>
                </label>
                <div class="artivceTitle">
                    <h3>{{ $sort_name }}</h3>
                    <span>{{ $sort_name_en }}</span>
                </div>
                <table class="table">
                    <tr><td>{{ $menu_name }}</td></tr>
                    <tr><td class="date">{{substr($menu_post_time,0,-8)}}</td></tr>
                    <tr class="dateo">
                        <td class="date1">日期</td><td class="title1">標題</td>
                    </tr>
                    @foreach($Faq as $faq)
                    <tr class="post_down"><td>{{substr($faq->post_time,0,-8)}}</td><td class="des_lef"><a href="/news/{{$faq->post_id}}/faq" class="share_title" title="{{$faq->post_title}}">{{$faq->post_title}}</a></td></tr>
                    @endforeach
                    <!-- <tr>
                        <td colspan="2">
                            <form action="/class/join" method="get">
                                <input type="hidden" name="menu_id" value="{{ $menu[0]->menu_id }}">
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
                {{-- 分頁頁數按鈕 --}}
                <div style="text-align:center">
                    @if($Faq->currentPage()-1 > 0)
                    <a href="/news/share?page=1">&nbsp;&nbsp;第一頁&nbsp;&nbsp;</a>
                    @endif
                    @if($Faq->currentPage()-1 > 0)
                    <a href="{{ $Post->previousPageUrl() }}">&nbsp;&nbsp;上一頁&nbsp;&nbsp;</a>
                    @endif
                    @for($i=1;$i<=$total_pages;$i++)
                        @if($i!=$Faq->currentPage())
                            <a href="/news/share?page={{$i}}">&nbsp;&nbsp;{{$i}}&nbsp;&nbsp;</a>
                        @else
                            &nbsp;&nbsp;{{$i}}&nbsp;&nbsp;
                        @endif
                    @endfor
                    @if($Faq->currentPage()-1 >= 0 && $Faq->currentPage()!=$Faq->lastPage())
                    <a href="{{ $Faq->nextPageUrl() }}">&nbsp;&nbsp;下一頁&nbsp;&nbsp;</a>
                    @endif
                    @if($Faq->hasMorePages() > 0)
                    <a href="/news/share?page={{ $Faq->lastPage() }}">&nbsp;&nbsp;最後一頁&nbsp;&nbsp;</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
 