<?php $__env->startSection('title',$site_title); ?>
<?php $__env->startSection('description',$site_description); ?>
<?php $__env->startSection('content'); ?>
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
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e($breadcrumb->breadcrumb_api); ?>"><div><?php echo e($breadcrumb->breadcrumb_name_en); ?></div><div><?php echo e($breadcrumb->breadcrumb_name); ?></div></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            </div>
        </div>
        <div class="bg"><img src="/images/news/lake.png" alt="lake.png"></div>
        <div class="col-md-12">
            <?php echo $__env->make('front.inside.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-9" style="float:right;">
                
                <?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <label style="float:right">
                    <div>首頁 > <?php echo e($sort_name); ?></div>
                </label>
                <div class="artivceTitle">
                    <h3><?php echo e($sort_name); ?></h3>
                    <span><?php echo e($sort_name_en); ?></span>
                </div>
                <table class="table">
                    <tr><td><?php echo e($title); ?></td></tr>
                    <tr><td class="date"><?php echo e(substr($post_time,0,-8)); ?></td></tr>
                    <tr><td><?php echo htmlspecialchars_decode($description); ?></td></tr>
                    <tr>
                        <td>
                            <?php if($id > DB::table('posts')->min('post_id')): ?>
                            <a href="/news/<?php echo e($id-1); ?>/itm">上一頁</a>
                            <?php endif; ?>
                            <?php if($id < DB::table('posts')->max('post_id')): ?>
                            <a href="/news/<?php echo e($id+1); ?>/itm" style="float:right">下一頁</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="/news/share" style="float:right">回新聞列表 ></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('front.masterInside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/front/showPostItem.blade.php ENDPATH**/ ?>