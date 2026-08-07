@extends('front.master')
@section('title', $title)
@section('description', $description)
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	@foreach($presents as $key => $presents)
	<div class="container">
		<!-- <div class="topNav">	
            <div class="nav">
            <h3>網站主選單</h3>
            <ul class="Breadcrumbs">
                @foreach($breadcrumbs as $breadcrumb)
                <li><a href="{{ $breadcrumb->breadcrumb_api }}"><div>{{ $breadcrumb->breadcrumb_name_en }}</div><div>{{ $breadcrumb->breadcrumb_name }}</div></a></li>
                @endforeach
            </ul>
            </div>
        </div> -->
		<div class="container upside">
			<div class="avatar">
				<img src="{{ $presents->resume_picme }}" alt="我的照片" title="我的照片" class="avatar_img">	
			</div>
			<div class="about_me">
				<span>
					{{ $presents->resume_introduction}}
					
				</span>
			</div>
		</div>

		<div class="container info">
			<span class="title">基本資料 | Info</span>
			<div class="inf_bor">
				<div class="inf_tit">姓名</div><div class="inf_des">{{ $presents->resume_nickname}}</div><br/>
				<div class="inf_tit">性別</div><div class="inf_des">@if($presents->resume_sex==1)男@else女@endif</div><br/>
				<div class="inf_tit">年齡</div><div class="inf_des">{{ $presents->resume_age}}</div><br/>
				<!-- <div class="inf_tit">婚姻狀態</div><div class="inf_des">@if($presents->resume_marry==1)未婚@else已婚@endif</div><br/> -->
				<div class="inf_tit">學歷</div><div class="inf_des">{{ $presents->resume_education}}</div><br/>
				<div class="inf_tit">手機</div><div class="inf_des">{{ $presents->resume_cellphone}}</div><br/>
				<div class="inf_tit">信箱</div><div class="inf_des">{{ $presents->resume_email}}</div><br/>
			</div>
		</div>

		<div class="container intro">
			<span class="smy">簡介 | Intro</span>
			<div class="smy_intro">
				<div>{{ $presents->resume_summary}}</div>
			</div>
		</div>

		<div class="container exper">
			<span class="exper_tit">經歷 | Experience</span>
			<div class="exper_bor">
				<div class="wrap">
				<ul class="list">
					@foreach(json_decode($presents->resume_experience, true) as $key => $value)
					<li>
						<p class="exper_des">	
							在職時間:{{ json_decode($presents->resume_experience, true)[$key]['在職時間'] }}<br>
							公司:{{ json_decode($presents->resume_experience, true)[$key]['公司'] }}<br>
							職稱:{{ json_decode($presents->resume_experience, true)[$key]['職稱'] }}				
						</p>	
					</li>
					@endforeach		
				</ul>
				</div>
			</div>
		</div>

		<div class="container skil_cont">
			<span class="skil_tit">技能 | Skill</span>
			<div class="wrap">
				<ul class="skill">
					@php
						$data = json_decode($presents->resume_skill, true);
					@endphp
					<h2>前端</h2>
					@foreach($data as $key => $value)
					@if($data[$key]['type']=="frontend")
					<li class="skil_bor">
						<p>
							<div class="skil_bor_nam">{{ $data[$key]['skill'] }}</div><div class="star-container star_ctrl">
							@php
							$totalStars = 5; // 定義總星星數
							$yellowStars = $data[$key]['trained']; // 定義黃色星星數

							for ($i = 1; $i <= $totalStars; $i++) {
								if ($i <= $yellowStars) {
									echo '<span class="fas fa-star" style="color:yellow;/* 設定外框粗細和顏色 */
    /* -webkit-text-stroke: 3px #ffff8a;*/"></span>';// 前三個圓圈
								}else{
									echo '<span class="far fa-star" style="color:yellow;/* 設定外框粗細和顏色 */
    /* -webkit-text-stroke: 3px #f0f0f0; */"></span>';// 剩兩個圓圈
								}
							}
							@endphp
							</div>
						</p>
					</li>
					@endif
					@endforeach
					<hr>
					<h2>後端</h2>
					@foreach($data as $key => $value)
					@if($data[$key]['type']=="backend")
					<li class="skil_bor">
						<p>
							<div class="skil_bor_nam">{{ $data[$key]['skill'] }}</div><div class="star-container star_ctrl">
							@php
							$totalStars = 5; // 定義總星星數
							$yellowStars = $data[$key]['trained']; // 定義黃色星星數

							for ($i = 1; $i <= $totalStars; $i++) {
								if ($i <= $yellowStars) {
									echo '<span class="fas fa-star" style="color:yellow;/* 設定外框粗細和顏色 */
    /* -webkit-text-stroke: 3px #ffff8a; */"></span>';// 前三個圓圈
								}else{
									echo '<span class="far fa-star" style="color:yellow;/* 設定外框粗細和顏色 */
    /* -webkit-text-stroke: 3px #f0f0f0; */"></span>';// 剩兩個圓圈
								}
							}
							@endphp
							</div>
						</p>
					</li>
					@endif
					@endforeach
       
					
				</ul>
			</div>
		</div>

		
		
		<div class="container intro">
		<span class="sign_proj">開發經驗，作品   |   Works</span>
		<div class="sign_proj_bor">
			@foreach(json_decode($presents->resume_sideproject, true) as $key => $value)
				<a href="{{ json_decode($presents->resume_sideproject, true)[$key]['連結'] }}">
					<div class="sign_proj_tit">
						
						<img src="{{ json_decode($presents->resume_sideproject, true)[$key]['路徑'] }}" alt="{{ json_decode($presents->resume_sideproject, true)[$key]['說明'] }}" style="width: 100px;height: 60px;">
					</div>
					<div style="position: absolute;margin: 85px 20px;">{{ json_decode($presents->resume_sideproject, true)[$key]['圖片名稱'] }}</div>
				</a>		
			@endforeach		
		</div>
		</div>
		<div class="container ctn_bor">
		<div style="background-color:#52f6de;color:white;text-align:center;">聯絡我</div>
		<div class="contant" style="color:gray;text-align:center;">手機:{{ $presents->resume_cellphone }}</div>
		<div style="color:gray;text-align:center;">信箱:{{ $presents->resume_email }}</div>
		</div>
	</div>
	@endforeach
		<div class="container" >
			<div class="swiper mySwiper">
				<div class="swiper-wrapper">
					
						<div class="swiper-slide">
							<a href="">
								<img src="" alt="" title="">
								<div class="carousel-caption"></div>
							</a>
						</div>	
							
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