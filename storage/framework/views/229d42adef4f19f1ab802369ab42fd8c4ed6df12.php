<!-- 指定繼承 layout.master 母模板 -->


<!-- 傳送資料到母模板，並指定變數為 title -->
<?php $__env->startSection('title', $title); ?>

<!-- 傳送資料到母模板，並指定變數為 content -->
<?php $__env->startSection('content'); ?>
<link href="/summernote/summernote.min.css" rel="stylesheet">
    <script src="/summernote/summernote.min.js"></script>
<div class="container">
	<!-- <h1><?php echo e($title); ?></h1> -->

	
	<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <a href="/news/managesort"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
                <button type="button" class="btn btn-info" title="<?php echo e($title); ?>"><?php echo e($title); ?></button>
            </h3>
                

            <div class="card-tools">
	          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
	            <i class="fas fa-minus"></i></button>
	          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	            <i class="fas fa-times"></i></button>
	        </div> 
        </div>
          <!-- /.card-header -->
        <div class="card-body">
            <form action="<?php echo e('/news/addsortdeal'); ?>" method="post">
                
				<?php echo e(csrf_field()); ?>

                
                <?php echo e(method_field('PUT')); ?>

                <div class="container">
                    <div class="form-group col-md-3">
                        <label for="sort_name">類別名稱:</label>
                        <input class="form-control" type="text" name="sort_name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sort_name_en">類別名稱(英文):</label>
                        <input class="form-control" type="text" name="sort_name_en">
                    </div>
                    <input type="hidden" name="sort_display" value="1" class="Btn btn-primary">
                    <button type="submit" class="btn btn-primary">新增</button>
                </div>
            </form>
		</div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/news/newsAddSort.blade.php ENDPATH**/ ?>