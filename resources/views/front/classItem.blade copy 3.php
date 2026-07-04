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
   
		<div class="col-md-6 " style="height: 240px;">
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
		<div class="col-md-6"  style="height: 240px;">
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
		
	</div>
@endsection