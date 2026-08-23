@extends('front.master')
@section('title', $title)
@section('description', $description)
@section('content')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" type="text/css" />

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
					<li>
					@php
						$data = json_decode($presents->resume_skill, true);
					@endphp
					<h2>前端</h2>
					@foreach($data as $key => $value)
					@if($data[$key]['type']=="frontend")
					<ul class="skil_bor">
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
					</ul>
					@endif
					@endforeach
					</li>
					<hr>
					<li class="skill_li2">
					<h2>後端</h2>
					@foreach($data as $key => $value)
					@if($data[$key]['type']=="backend")
					<ul class="skil_bor">
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
					</ul>
					@endif
					@endforeach
					</li>
					
				</ul>
			</div>
		</div>

		<style>
			/* 1. 外層容器：固定範圍，隱藏超出部分 */
			.img-container {
				/*width: 400px; */        /* 根據需求設定寬度 */
				/*height: 300px; */       /* 根據需求設定高度 */
				overflow: hidden;     /* 超出容器範圍的圖片部分隱藏 */
				border-radius: 8px;   /* 選擇性：加上圓角 */
				margin: 0 15px;
			}

			/* 2. 圖片本體：設定過渡動畫 */
			.img-container img {
				width: 100%;
				height: 100%;
				object-fit: cover;
			
				/* 動畫平滑設定：轉換過程耗時 0.3 秒，使用 ease 緩動 */
				transition: transform 0.3s ease;
			}

			/* 3. 懸停效果：滑鼠移上去時放大 */
			.img-container:hover img {
				transform: scale(1.1); /* 放大至 1.1 倍 (可自行調整，例如 1.05 或 1.2) */
			}
		</style>
		
		<div class="container intro">
		<span class="sign_proj">開發經驗，作品   |   Works</span>
		<div class="banner-grid">
			@php
				$sideprojects = json_decode($presents->resume_sideproject, true) ?? [];
			@endphp

			@foreach($sideprojects as $item)
				<a href="{{ $item['連結'] ?? '#' }}" class="banner-item" target="_blank">
				<div class="banner-img-box">
					<picture>
					<source media="(max-width: 768px)" srcset="{{ asset($item['路徑']) }}">
					<img src="{{ asset($item['路徑']) }}" alt="{{ $item['圖片名稱'] ?? '' }}" class="banner-img">
					</picture>
				</div>

				<!-- 圖片名稱 -->
				<div class="banner-title">
					{{ $item['圖片名稱'] ?? '' }}
				</div>
				</a>
			@endforeach
			</div>
		</div>
		<div class="container ctn_bor">
			<div style="background-color:#52f6de;color:white;text-align:center;">聯絡我</div>
			<div class="contant" style="color:gray;text-align:center;">手機:{{ $presents->resume_cellphone }}</div>
			<div style="color:gray;text-align:center;">Line:<a href="https://line.me/ti/p/UCpYE6WinW">{{ $PostPaginate[0]->site_lineid }}</a></div>
			<div style="color:gray;text-align:center;">信箱:{{ $presents->resume_email }}</div>
		</div>
	</div>
	@endforeach		
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
<style>
/* 1. 隱藏原生箭頭圖示 (加上 !important 確保強制蓋掉 Swiper 預設) */
.swiper-button-prev::after,
.swiper-button-next::after {
  display: none !important;
  content: "" !important;
}

/* 2. 設定按鈕尺寸與背景 */
.swiper-button-prev,
.swiper-button-next {
  width: 40px !important;
  height: 40px !important;
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
}

/* 3. 左箭頭：帶入圖片 */
.swiper-button-prev {
  background-image: url('/images/present/gemini-svg.svg');
}

/* 4. 右箭頭：帶入圖片並「水平翻轉 (scaleX(-1))」 */
.swiper-button-next {
  background-image: url('/images/present/gemini-svg.svg');
  transform: translateY(-50%) scaleX(-1); /* ⭐️ 關鍵：維持原本居中並水平翻轉 */
}
</style>
@endsection