<?php $__env->startSection('title',$site_title); ?>
<?php $__env->startSection('description',$site_description); ?>
<?php $__env->startSection('content'); ?>
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
                    <tr><td><?php echo e($menu_name); ?></td></tr>
                    <tr><td class="date"><?php echo e(substr($menu_post_time,0,-8)); ?></td></tr>
                    <tr class="dateo">
                        <td class="date1">日期</td><td class="title1">標題</td>
                    </tr>
                    <?php $__currentLoopData = $Post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="post_down"><td><?php echo e(substr($post->post_time,0,-8)); ?></td><td class="des_lef"><a href="/news/<?php echo e($post->post_id); ?>/itm" class="share_title" title="<?php echo e($post->post_title); ?>"><?php echo e($post->post_title); ?></a></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- <tr>
                        <td colspan="2">
                            <form action="/class/join" method="get">
                                <input type="hidden" name="menu_id" value="<?php echo e($menu[0]->menu_id); ?>">
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
                
                <div style="text-align:center;margin-left: calc(100% - 40vw);">
                    <?php if($Post->currentPage()-1 > 0): ?>
                    <a href="/news/share?page=1">&nbsp;&nbsp;<div style="float:left;padding: 0 2%;">第一頁</div>&nbsp;&nbsp;</a>
                    <?php endif; ?>
                    <?php if($Post->currentPage()-1 > 0): ?>
                    <a href="<?php echo e($Post->previousPageUrl()); ?>">&nbsp;&nbsp;<div style="float:left;padding: 0 2%;">上一頁</div>&nbsp;&nbsp;</a>
                    <?php endif; ?>
                    <?php for($i=1;$i<=$total_pages;$i++): ?>
                        <?php if($i!=$Post->currentPage()): ?>
                            <a href="/news/share?page=<?php echo e($i); ?>" style="float:left;padding: 0 2%;">&nbsp;&nbsp;<?php echo e($i); ?>&nbsp;&nbsp;</a>
                        <?php else: ?>
                            &nbsp;&nbsp;<div style="float: left;color: #760080;font-size: 32px;padding: 2%;margin-top: calc(100% - 90vh);line-height: 20px;font-weight: bold;border-radius: 50%;width: 50px;background-color: #00fffd;"><?php echo e($i); ?></div>&nbsp;&nbsp;
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if($Post->currentPage()-1 >= 0 && $Post->currentPage()!=$Post->lastPage()): ?>
                    <a href="<?php echo e($Post->nextPageUrl()); ?>">&nbsp;&nbsp;<div style="float:left;padding: 0 2%;">下一頁</div>&nbsp;&nbsp;</a>
                    <?php endif; ?>
                    <?php if($Post->hasMorePages() > 0): ?>
                    <a href="/news/share?page=<?php echo e($Post->lastPage()); ?>">&nbsp;&nbsp;<div style="float:left;padding: 0 2%;">最後一頁</div>&nbsp;&nbsp;</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make('front.masterInside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/front/showNewsShare.blade.php ENDPATH**/ ?>