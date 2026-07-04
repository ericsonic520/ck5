@extends('front.master')
@section('title', $title)
@section('description', $description)
@section('content')
<!-- 自定義的style放在<head>內 -->
<style>
.swiper-wrapper{
	
}
    .swiper-top {
  position: relative;
  width: 100%;
  margin: auto;
}

.swiper {
  width: calc(100% - 100px);
  margin: auto;
  height: 200px;
  pointer-events: none;
}

.swiper-slide {
	pointer-events: auto!important;
}

.swiper-slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.swiper-pagination.swiper-pagination-1{
  bottom: -2rem;
}

.swiper-button-prev{
	font-size: 40px!important;
    color: green!important;
	top: var(--swiper-navigation-top-offset, 20%)!important;
	right: var(--swiper-navigation-sides-offset, 10px)!important;
	left: auto!important;
}

.swiper-button-next {
	font-size: 40px!important;
    color: green!important;
	top: var(--swiper-navigation-top-offset, 60%)!important;
	right: var(--swiper-navigation-sides-offset, 10px)!important;
	
}

.swiper-button-prev::after,.swiper-button-next::after{
    content:''!important;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<div class="container">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>
		
		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			@foreach ($CarouselPaginate as $key => $carousel)
				@if($carousel->carousel_range=='1')
				<div class="item active">
				@else
				<div class="item">
				@endif
					<img src="{{ $carousel->carousel_image }}" alt="{{ $carousel->carousel_description }}" title="{{ $carousel->carousel_description }}">
					<div class="carousel-caption">{{ $carousel->carousel_title }}</div>
				</div>	
			@endforeach
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		
    </div>

	
	<div class='swiper-top'>
	<div class="swiper mySwiper">
		<div class="swiper-wrapper">
		@foreach($PostPaginate as $Post)
				<div class="swiper-slide">
				
						•<a style="color:black;text-decoration:none;" href="news/{{$Post->post_id}}/itm" title="{{$Post->post_title}}">{{ Illuminate\Support\Str::limit($Post->post_title, 50, '...') }}</a>
				
						{{substr($Post->post_time,0,-8)}}
						
				</div>
				@endforeach
		</div>
	</div>
	<div class="swiper-pagination swiper-pagination-1"></div>
	<div class="swiper-button-next"><i class="fa-regular fa-circle-down"></i></div>
	<div class="swiper-button-prev "><i class="fa-regular fa-circle-up"></i></div>
	</div>
	

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
       var swiper = new Swiper(".mySwiper", {
		effect: 'fade',
		fadeEffect: {
			crossFade: true,
		},
		height: 120,
		// lazyPreloadPrevNext: 0,
		// initialSlide: 1,
		// noSwiping: true,
		slidesPerView: 1,
		spaceBetween: 16,
		breakpoints: {
			576: {
				slidesPerView: 2,
				},
			'@1.5': {
			slidesPerView: 1,
			}
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		// pagination: {
		// 	el: ".swiper-pagination",
		// 	clickable: true,
		// },
		grid: {
			fill: 'column',
			rows: 5,
		},
		
		});
		
		// $( ".swiper-wrapper > div:nth-child(n)" ).addClass( "swiper-slide-active" );
    </script>
   
		<div class="col-md-6 " style="height: 240px;">
			{{-- 錯誤訊息模板元件 --}}
			@include('components.validationErrorMessage')
			<table class="table table-hover table-dark">
				<tr class="text-center">
					<th style="text-align: left;">News&Notice 案例分享</th>
 					<th style="width:20%;text-align: right;"><a href="{{url('/news/share')}}" style="color:#4fff00;text-decoration:none;">more</a></th>		
				</tr>
				@foreach($PostPaginate as $Post)
				<tr class="text-center">
					<td style="text-align: left;">
						•<a style="color:black;text-decoration:none;" href="news/{{$Post->post_id}}/itm" title="{{$Post->post_title}}">{{ Illuminate\Support\Str::limit($Post->post_title, 50, '...') }}</a>
					</td>
					<td style="text-align: left;">
						{{substr($Post->post_time,0,-8)}}
					</td>
					<td>
						<div style="text-align:center;margin-left: calc(100% - 40vw);">
							<!-- @if($PostPaginate->currentPage()-1 > 0)
							<a href="/news/share?page=1">&nbsp;&nbsp;<div style="float:left;padding: 0 2%;">第一頁</div>&nbsp;&nbsp;</a>
							@endif -->
							@if($PostPaginate->currentPage()-1 > 0)
								<a href="{{ $PostPaginate->previousPageUrl() }}"><div style="float: left;font-size: 40px;color: purple;position: absolute;left: 545px;top: calc(100% - 25vh);"><i class="fa-regular fa-circle-up"></i><!-- 上一頁 --></div></a>
							@endif
							<!-- @for($i=1;$i<=$total_pages;$i++)
								@if($i!=$PostPaginate->currentPage())
									<a href="/news/share?page={{$i}}" style="float:left;padding: 0 2%;">&nbsp;&nbsp;{{$i}}&nbsp;&nbsp;</a>
								@else
									&nbsp;&nbsp;<div style="float: left;color: #760080;font-size: 32px;padding: 2%;margin-top: calc(100% - 90vh);line-height: 20px;font-weight: bold;border-radius: 50%;width: 50px;background-color: #00fffd;">{{$i}}</div>&nbsp;&nbsp;
								@endif
							@endfor -->
							@if($PostPaginate->currentPage()-1 >= 0 && $PostPaginate->currentPage()!=$PostPaginate->lastPage())
							<a href="{{ $PostPaginate->nextPageUrl() }}"><div style="float: left;font-size: 40px;color: purple;position: absolute;left: 545px;top: calc(100% - 17vh);"><i class="fa-regular fa-circle-down"></i><!-- 下一頁 --></div></a>
							@endif
							<!-- @if($PostPaginate->hasMorePages() > 0)
							<a href="/news/share?page={{ $PostPaginate->lastPage() }}">&nbsp;&nbsp;<div style="float:left;padding: 0 2%;">最後一頁</div>&nbsp;&nbsp;</a>
							@endif -->
						</div>
					</td>
				</tr>
				@endforeach
				{{-- 分頁頁數按鈕 --}}
			<!-- <div style="text-align:center;margin-left: calc(100% - 40vw);">
				@if($PostPaginate->currentPage()-1 > 0)
				<a href="{{ $PostPaginate->previousPageUrl() }}"><div style="float: left;font-size: 40px;color: purple;position: absolute;left: 545px;top: calc(100% - 40vh);"><i class="fa-regular fa-circle-up"></i></div></a>
				@endif
				
				@if($PostPaginate->currentPage()-1 >= 0 && $PostPaginate->currentPage()!=$PostPaginate->lastPage())
				<a href="{{ $PostPaginate->nextPageUrl() }}"><div style="float: left;font-size: 40px;color: purple;position: absolute;left: 545px;top: calc(100% - 30vh);"><i class="fa-regular fa-circle-down"></i></div></a>
				@endif
				
			</div> -->
			</table>
			
			<br>
		</div>
		<div class="col-md-6 ">
			{{-- 錯誤訊息模板元件 --}}
			@include('components.validationErrorMessage')
			<table class="table table-hover table-dark">
				<tr class="text-center">
					<th style="text-align: left;">Q&A 各項服務</th>
					<th style="width:20%;text-align: right;"><a href="{{url('/news/faq')}}" style="color:#4fff00;text-decoration:none;">more</a></th>
					
				</tr>
				@foreach($FaqPaginate as $Faq)
				<tr class="text-center">
					<td style="text-align: left;">
						•<a style="color:black;text-decoration:none;" href="news/{{$Faq->post_id}}/faq" title="{{$Faq->post_title}}">{{ Illuminate\Support\Str::limit($Faq->post_title, 50, '...') }}</a>
					</td>
					<td style="text-align: right;">
					{{substr($Faq->post_time,0,-8)}}
					</td>
					<td>
						<div style="text-align:center;margin-left: calc(100% - 40vw);">
							<!-- @if($FaqPaginate->currentPage()-1 > 0)
							<a href="/news/share?page=1">&nbsp;&nbsp;<div style="float:left;padding: 0 2%;">第一頁</div>&nbsp;&nbsp;</a>
							@endif -->
							@if($FaqPaginate->currentPage()-1 > 0)
								<a href="{{ $FaqPaginate->previousPageUrl() }}"><div style="float: left;font-size: 40px;color: purple;position: absolute;left: 545px;top: calc(100% - 25vh);"><i class="fa-regular fa-circle-up"></i><!-- 上一頁 --></div></a>
							@endif
							<!-- @for($i=1;$i<=$total_pages;$i++)
								@if($i!=$FaqPaginate->currentPage())
									<a href="/news/share?page={{$i}}" style="float:left;padding: 0 2%;">&nbsp;&nbsp;{{$i}}&nbsp;&nbsp;</a>
								@else
									&nbsp;&nbsp;<div style="float: left;color: #760080;font-size: 32px;padding: 2%;margin-top: calc(100% - 90vh);line-height: 20px;font-weight: bold;border-radius: 50%;width: 50px;background-color: #00fffd;">{{$i}}</div>&nbsp;&nbsp;
								@endif
							@endfor -->
							@if($FaqPaginate->currentPage()-1 >= 0 && $FaqPaginate->currentPage()!=$FaqPaginate->lastPage())
							<a href="{{ $FaqPaginate->nextPageUrl() }}"><div style="float: left;font-size: 40px;color: purple;position: absolute;left: 545px;top: calc(100% - 17vh);"><i class="fa-regular fa-circle-down"></i><!-- 下一頁 --></div></a>
							@endif
							<!-- @if($FaqPaginate->hasMorePages() > 0)
							<a href="/news/share?page={{ $FaqPaginate->lastPage() }}">&nbsp;&nbsp;<div style="float:left;padding: 0 2%;">最後一頁</div>&nbsp;&nbsp;</a>
							@endif -->
						</div>
					</td>
				</tr>
				@endforeach
			</table>
			<br>
		</div>
		
	</div>
@endsection