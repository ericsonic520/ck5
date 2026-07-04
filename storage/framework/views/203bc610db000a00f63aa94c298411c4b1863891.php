
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
	<div class="container">
		<!-- <h1><?php echo e($title); ?></h1> -->

		<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="card">
      <div class="card-header">
        <!-- <h3 class="card-title"><?php echo e($title); ?></h3>&nbsp;&nbsp; -->
        <a href="/news/add"><button type="button" class="btn btn-success"><!--<i class="fas fa-solid fa-plus"></i>-->新增新聞</button></a>
        <a href="/news/managesort"><button type="button" class="btn btn-info"><!--<i class="fas fa-solid fa-plus"></i>-->類別管理</button></a>
        <a href="/news/managebreadcrumbs"><button type="button" class="btn btn-warning"><!--<i class="fas fa-solid fa-plus"></i>-->麵包屑管理</button></a>
        <a href="/news/manageMenu"><button type="button" class="btn btn-primary"><!--<i class="fas fa-solid fa-plus"></i>-->選單管理</button></a>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <tbody class="text-center">
          	<tr>
              <th>ID</th>
              <th>類別</th>
              <th>新聞標題</th>
              <th>是否顯示</th>
              <th>操作</th>
          	</tr>
          	<?php $__currentLoopData = $PostPaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $Post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                  <td><?php echo e($Post->post_id); ?></td>
                  <td><?php echo e($Post->sort_name); ?></td>
                  <td><a href="news/<?php echo e($Post->post_id); ?>/itm" style="color: black;text-decoration: none;" title="<?php echo e($Post->post_title); ?>"><?php echo e($Post->post_title); ?></a></td>
                  <td>
                      <form action="/news/<?php echo e($Post->post_id); ?>/chgnewsdis" enctype="multipart/form-data">
                        <?php if($Post->post_display=='1'): ?>
                          <button method="submit" class="btn btn-success" title="顯示"><i class="far fa-eye"></i></button>
                        <?php endif; ?>
                        <?php if($Post->post_display=='0'): ?>
                          <button method="submit" class="btn btn-warning" title="隱藏"><i class="fas fa-solid fa-eye-slash"></i></button>
                        <?php endif; ?>
                        <input type="hidden" name="post_display" value="<?php echo e($Post->post_display); ?>">
                      </form> 
                  </td>
                  <td>
                  
                  <?php if(auth()->guard()->guest()): ?>
                    <?php else: ?> 
                      <?php if(Auth::user()->type=='A'): ?>
                      <a href="/news/<?php echo e($Post->post_id); ?>/itm" title="頁面連結">
                      <button class="btn btn-info"><i class="fas fa-solid fa-list"></i></button>
                      </a>
                        <a href="/news/<?php echo e($Post->post_id); ?>/edit" title="更新內容">
                          <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                        </a>
                        <!--<a href="/warning">
                          <button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
                        </a>-->
                        <!-- <a href="news/<?php echo e($Post->post_id); ?>/del" onclick="javascript:return del();">
                          <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </a> -->
                      <?php else: ?>
                      <?php endif; ?>
                    <?php endif; ?>
                    
                  </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
          </tbody>
      	</table>
        
		    <?php echo e($PostPaginate->links()); ?>

      </div>
      
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/News/newsList.blade.php ENDPATH**/ ?>