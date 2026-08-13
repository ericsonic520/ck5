@extends('front.master')
@section('title', $title)
@section('description', $description)
@section('content')
<!-- 自定義的style放在<head>內 -->

<style>
.parent {
	width: 100%;
	height: 180px;
	/* position: relative; */
	overflow:scroll;
	overflow-x:hidden;
}
.child{
	/* position: absolute; */
	/* bottom: 0; */
	line-height: 35px;
}
</style>
<style>
	    /* html,
    body {
      position: relative;
      height: 100%;
    }

    body {
      background: #eee;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #000;
      margin: 0;
      padding: 0;
    } */

    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

	/* 1. 先清空 Swiper 預設字型設定 */
.swiper-button-next::after,
.swiper-button-prev::after {
    font-family: inherit; /* 改用系統預設字型 */
    font-size: 24px;
    font-weight: bold;
}



/* 粗體箭頭 ▶ */
.swiper-button-next::after {
    content: '▶'; /* 或 '\25B6' */
}

</style>
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
		<div class="container">
			<div class="swiper mySwiper">
				<div class="swiper-wrapper">
					@foreach ($CarouselPaginate as $key => $carousel)
						<div class="swiper-slide">
							<a href="">
								<img src="{{ $carousel->carousel_image }}" alt="{{ $carousel->carousel_description }}" title="{{ $carousel->carousel_description }}">
								<div class="carousel-caption">{{ $carousel->carousel_title }}</div>
							</a>
						</div>	
					@endforeach			
				</div>
				<!-- If we need pagination -->
				<div class="swiper-pagination"></div>

				<!-- If we need navigation buttons -->
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>

				<!-- If we need scrollbar -->
				<div class="swiper-scrollbar"></div>
			</div>
		</div>
   
		<div class="col-md-6 ">
			{{-- 錯誤訊息模板元件 --}}
			@include('components.validationErrorMessage')
			<div class="table table-hover table-dark">
				<div class="text-center">
					<div style="float:left;width:80%;text-align: left;">News&Notice 案例分享</div>
 					<div style="float:left;width:20%;text-align: right;"><a href="{{url('/news/share')}}" style="color:#4fff00;text-decoration:none;">more</a></div>		
				</div>
				<div class="@if($postall>5) parent @endif">
					@foreach($PostPaginate as $Post)
					<div class="child" style="float:left;width: 80%;">
						•<a style="color:black;text-decoration:none;" href="news/{{$Post->post_id}}/itm" title="{{$Post->post_title}}">{{ Illuminate\Support\Str::limit($Post->post_title, 50, '...') }}</a>
					</div>
					<div style="float:left;width:20%;text-align: right;">
						{{substr($Post->post_time,0,-8)}}
					</div>
					@endforeach
				</div>
			</div>
			
			<br>
		</div>
		<div class="col-md-6">
			{{-- 錯誤訊息模板元件 --}}
			@include('components.validationErrorMessage')
			<div class="table table-hover table-dark">
				<div class="text-center">
					<div style="float:left;width:80%;text-align: left;">Q&A 各項服務</div>
					<div style="float:left;width:20%;text-align: right;"><a href="{{url('/news/faq')}}" style="color:#4fff00;text-decoration:none;">more</a></div>
					
				</div>
				<div class="@if($faqall>5) parent @endif">
					@foreach($FaqPaginate as $faq)
					<div class="child" style="float:left;width: 80%;">
						•<a style="color:black;text-decoration:none;" href="news/{{$faq->post_id}}/itm" title="{{$faq->post_title}}">{{ Illuminate\Support\Str::limit($faq->post_title, 50, '...') }}</a>
					</div>
					<div style="float:left;width:20%;text-align: right;">
						{{substr($faq->post_time,0,-8)}}
					</div>
					@endforeach
				</div>
			</div>
			<br>
		</div>
		<div class="col-md-12">
			<iframe width="100%" height="800" src="https://www.youtube.com/embed/GWLEk0EBz5U?si=VmKNIVoJ99gbhEeh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
		</div>
		<div class="col-md-12">
			<label for="placeholder">藝術家據點:220新北市板橋區新興里南雅南路一段5巷19號2 樓</label>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3615.842009128057!2d121.45650669999999!3d25.005483900000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346802a898f7727b%3A0x6d7d862a38859c1e!2z6Jed6KGT5a62576O5a6557SL57mhIOeyiemcp-eciQ!5e0!3m2!1szh-TW!2stw!4v1786036260496!5m2!1szh-TW!2stw" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
		</div>
	</div>
	
	<!-- 貼到 </body> 之前 -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
	var swiper = new Swiper(".mySwiper", {
		// 分頁、左右箭頭、滾動條若有使用則必需設定          
		// 分頁   
		// pagination: {
		// 	el: '.swiper-pagination',
		// },
		// 左右箭頭    
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		// 滾動條
		// scrollbar: {
		// 	el: '.swiper-scrollbar',
		// },
		slidesPerView: 1,
		spaceBetween: 10,
		autoplay: {
			delay: 1500
		}
	});
</script>
@endsection