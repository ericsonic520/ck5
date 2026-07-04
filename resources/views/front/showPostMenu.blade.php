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
    #social-links ul li{
        display: inline-block;
    }

    #social-links ul li:nth-child(1) a{
        padding:1px 5px;
        margin: 2px;
        font-size: 30px;
        color: rgb(46,41,114);
        background-color: #fff;
    }

    #social-links ul li:nth-child(1) a:hover{
        background-color: rgb(46,41,114);
        color: white;
    }

    #social-links ul li:nth-child(2) a{
        padding:1px 5px;
        margin: 2px;
        font-size: 30px;
        color: rgb(6 194 13);
        background-color: #fff;
    }

    #social-links ul li:nth-child(2) a:hover{
        background-color: rgb(6 194 13);
        color: white;
    }

    #social-links ul li:nth-child(3) a{
        padding:1px 5px;
        margin: 2px;
        font-size: 30px;
        color: rgb(255 132 0);
        background-color: #fff;
    }

    #social-links ul li:nth-child(3) a:hover{
        background-color: rgb(255 132 0);
        color: white;
    }

    #social-links ul li:nth-child(4) a{
        padding:1px 5px;
        margin: 2px;
        font-size: 30px;
        background-color: #fff;
        color: rgb(0 173 255);
    }

    #social-links ul li:nth-child(4) a:hover{
        color: #fff;
        background-color: rgb(0 173 255);
        
    }
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
                    <tr><td class="date pb-5">{!! $shareButtons !!}</td></tr>
                    <tr><td>{!! htmlspecialchars_decode($menu_description) !!}</td></tr>
                    <script>
                        function chg(){
                            document.querySelector('.fa-pinterest').className = 'fa-brands fa-line';
                            document.querySelector('.fa-reddit').className = 'fa-brands fa-product-hunt';
                            // alert('1'); <i class="fa-brands fa-product-hunt"></i>
                        }
                        chg();
                    </script>
                </table>
            </div>
        </div>
    </div>
@endsection
 