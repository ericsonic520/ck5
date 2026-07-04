

<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
	<div class="container">
		<!-- <h1><?php echo e($title); ?></h1> -->

		<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="card">
      <div class="card-header">
      <button type="button" class="btn btn-success" title="<?php echo e($title); ?>"><?php echo e($title); ?></button>
        <?php if($site[0]->site_id=='1'): ?>
        <a href="/news/carouselManage"><button type="button" class="btn btn-info" title="輪播管理">輪播管理</button></a>
        <?php endif; ?> 
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      
        <?php echo e(method_field('PUT')); ?>

        <div class="form-group col-md-3">
          <label for="maintain">例行性維護:</label>
          <form action="/site/<?php echo e($site[0]->site_id); ?>/chgMainDis" enctype="multipart/form-data">
              <?php if($site[0]->site_maintain=='1'): ?>
                  <button method="submit" class="btn btn-warning" title="維護作業中"><!-- <i class="far fa-eye"></i> -->維護作業中</button>
              <?php endif; ?>
              <?php if($site[0]->site_maintain=='0'): ?>
                  <button method="submit" class="btn btn-success" title="系統開放中"><!-- <i class="fas fa-solid fa-eye-slash"></i> --> 系統開放中</button>
              <?php endif; ?>
              <input type="hidden" name="site_maintain" value="<?php echo e($site[0]->site_maintain); ?>">
              <input type="hidden" name="site_id" value="<?php echo e($site[0]->site_id); ?>">
          </form>
        </div>
        <form action="/site/chgSiteDis" enctype="multipart/form-data">
            <div class="form-group col-md-6">
                <label for="site_maintain_caption">開放網站:</label>
                <?php if($site_all): ?>
                <select name="site_chgdis_id" id="site_display" class="form-control">
                    <?php $__currentLoopData = $site_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($site2->site_id); ?>" <?php if(old('$site2->site_id', $site[0]->site_id) == $site2->site_id ): ?> selected <?php endif; ?> ><?php echo e($site2->site_name); ?></option>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
                <?php endif; ?>
            </div>
            <input type="hidden" name="site_display" value="<?php echo e($site[0]->site_id); ?>">
            <button type="submit" class="btn btn-success">更新</button>
        </form>
        <?php if($site[0]->site_id=='1'): ?>
        <form action="/site/<?php echo e($site[0]->site_id); ?>/chgMainDes" enctype="multipart/form-data">
          <div class="form-group col-md-6">
              <label for="site_maintain_caption">維護說明:</label>
              <input class="form-control" type="text" name="site_maintain_caption" value="<?php echo e(old('site_maintain_caption', $site[0]->site_maintain_caption)); ?>">
          </div>
        
          <div class="form-group col-md-6">
              <label for="site_title">網站標題:</label>
              <input class="form-control" type="text" name="site_title" value="<?php echo e(old('site_title', $site[0]->site_title)); ?>">
          </div>

          <div class="form-group col-md-6">
              <label for="site_description">網站說明:</label>
              <input class="form-control" type="text" name="site_description" value="<?php echo e(old('site_description', $site[0]->site_description)); ?>">
          </div>

          <div class="form-group col-md-3">
              <label for="site_name_en">網站英文名稱:</label>
              <input class="form-control" type="text" name="site_name_en" value="<?php echo e(old('site_name_en', $site[0]->site_name_en)); ?>">
          </div>

          <div class="form-group col-md-3">
              <label for="site_lineid">lineid:</label>
              <input class="form-control" type="text" name="site_lineid" value="<?php echo e(old('site_lineid', $site[0]->site_lineid)); ?>">
          </div>

          <div class="form-group col-md-3">
              <label for="site_wechartid">wechartid:</label>
              <input class="form-control" type="text" name="site_wechartid" value="<?php echo e(old('site_wechartid', $site[0]->site_wechartid)); ?>">
          </div>

          <div class="form-group col-md-3">
              <label for="site_cellphone">網站電話:</label>
              <input class="form-control" type="text" name="site_cellphone" value="<?php echo e(old('site_cellphone', $site[0]->site_cellphone)); ?>">
          </div>

          <div class="form-group col-md-6">
              <label for="site_address">網站地址:</label>
              <input class="form-control" type="text" name="site_address" value="<?php echo e(old('site_address', $site[0]->site_address)); ?>">
          </div>
        
          <button type="submit" class="btn btn-success">更新</button>
        </form>
        <?php endif; ?> 
        
        <?php echo e(csrf_field()); ?>

      </div>  
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/site/managelist2.blade.php ENDPATH**/ ?>