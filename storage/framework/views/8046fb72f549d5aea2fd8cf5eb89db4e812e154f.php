<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('description', $description); ?>
<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e($breadcrumb->breadcrumb_api); ?>"><div><?php echo e($breadcrumb->breadcrumb_name_en); ?></div><div><?php echo e($breadcrumb->breadcrumb_name); ?></div></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            </div>
        </div>
		<div class="container">
			<div class="swiper mySwiper">
				<div class="swiper-wrapper">
					<?php $__currentLoopData = $CarouselPaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="swiper-slide">
							<a href="">
								<img src="<?php echo e($carousel->carousel_image); ?>" alt="<?php echo e($carousel->carousel_description); ?>" title="<?php echo e($carousel->carousel_description); ?>">
								<div class="carousel-caption"><?php echo e($carousel->carousel_title); ?></div>
							</a>
						</div>	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>			
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
   
		<div class="col-md-6 " style="height: 240px;">
			
			<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="table table-hover table-dark">
				<div class="text-center">
					<div style="float:left;width:80%;text-align: left;">News&Notice 案例分享</div>
 					<div style="float:left;width:20%;text-align: right;"><a href="<?php echo e(url('/news/share')); ?>" style="color:#4fff00;text-decoration:none;">more</a></div>		
				</div>
				<div class="<?php if($postall>5): ?> parent <?php endif; ?>">
					<?php $__currentLoopData = $PostPaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="child" style="float:left;width: 80%;">
						•<a style="color:black;text-decoration:none;" href="news/<?php echo e($Post->post_id); ?>/itm" title="<?php echo e($Post->post_title); ?>"><?php echo e(Illuminate\Support\Str::limit($Post->post_title, 50, '...')); ?></a>
					</div>
					<div style="float:left;width:20%;text-align: right;">
						<?php echo e(substr($Post->post_time,0,-8)); ?>

					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			
			<br>
		</div>
		<div class="col-md-6"  style="height: 240px;">
			
			<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="table table-hover table-dark">
				<div class="text-center">
					<div style="float:left;width:80%;text-align: left;">Q&A 各項服務</div>
					<div style="float:left;width:20%;text-align: right;"><a href="<?php echo e(url('/news/faq')); ?>" style="color:#4fff00;text-decoration:none;">more</a></div>
					
				</div>
				<div class="<?php if($faqall>5): ?> parent <?php endif; ?>">
					<?php $__currentLoopData = $FaqPaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="child" style="float:left;width: 80%;">
						•<a style="color:black;text-decoration:none;" href="news/<?php echo e($faq->post_id); ?>/itm" title="<?php echo e($faq->post_title); ?>"><?php echo e(Illuminate\Support\Str::limit($faq->post_title, 50, '...')); ?></a>
					</div>
					<div style="float:left;width:20%;text-align: right;">
						<?php echo e(substr($faq->post_time,0,-8)); ?>

					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<br>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/front/classItem.blade.php ENDPATH**/ ?>