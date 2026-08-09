<!-- 指定繼承 layout.master 母模板 -->


<!-- 傳送資料到母模板，並指定變數為 title -->
<?php $__env->startSection('title', $title); ?>

<!-- 傳送資料到母模板，並指定變數為 content -->
<?php $__env->startSection('content'); ?>
<div class="container">
	<!-- <h1><?php echo e($title); ?></h1> -->

	
	<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
              <a href="/news/managebreadcrumbs"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
              <button type="button" class="btn btn-warning" title="<?php echo e($title); ?>"><?php echo e($title); ?></button>
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
            <form action="/news/<?php echo e($breadcrumb_id); ?>/breadcrumbEditDeal" method="post" enctype="multipart/form-data">

              
              <?php echo e(method_field('PUT')); ?>


              <div class="container">
                <div class="form-group col-md-3">
                    <label for="breadcrumb_name">麵包屑名稱:</label>
                    <input class="form-control" type="text" name="breadcrumb_name" value="<?php echo e(old('breadcrumb_name', $BreadcrumbPaginate[0]->breadcrumb_name)); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="breadcrumb_name_en">麵包屑名稱(英文):</label>
                    <input class="form-control" type="text" name="breadcrumb_name_en" value="<?php echo e(old('breadcrumb_name_en', $BreadcrumbPaginate[0]->breadcrumb_name_en)); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="breadcrumb_api">麵包屑API:</label>
                    <input class="form-control" type="text" name="breadcrumb_api" value="<?php echo e(old('breadcrumb_api', $BreadcrumbPaginate[0]->breadcrumb_api)); ?>">
                </div>
              </div>
          
            <button type="submit" class="btn btn-success">更新</button>
            
            <?php echo e(csrf_field()); ?>

          </form>
        </div>
        
          <!-- /.card-body -->
          <!-- <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div> -->
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/news/newsBreadcrumbEdit.blade.php ENDPATH**/ ?>