<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
	<div class="container">
		<!-- <h1><?php echo e($title); ?></h1> -->

		<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<div class="card">
      <div class="card-header">
        <h3 class="card-title"><?php echo e($title); ?></h3>

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
				<th>名稱</th>
				<th>相關圖片</th>
				<!-- <th>是否公開</th> -->
				<th>日期</th>
				<th>上課地點</th>
				<!-- <th>課程介紹</th> -->
				<th>名額</th>
          	</tr>
          	<?php $__currentLoopData = $CoursePaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($Course->id); ?></td>
					<td><?php if($Course->category=='C'): ?>
							<?php echo e($Course->name); ?>

						<?php endif; ?>
						<?php if($Course->category=='E'): ?>
							<?php echo e($Course->name); ?>

						<?php endif; ?>
						<?php if($Course->category=='M'): ?>
							<?php echo e($Course->name); ?>

						<?php endif; ?></td>
					<td>
						<?php if(!is_null($Course->pic)): ?>
		                            <img src="<?php echo e($Course->pic); ?>">
		                        <?php endif; ?>
		                        <?php if(is_null($Course->pic)): ?>
		                            <img src="<?php echo e('/images/class/5d0de69e07324.png'); ?>">
		                        <?php endif; ?>
					</td>
					<!-- <td>
						<?php if($Course->status == 'R'): ?>
							<span class="label label-default" style="border-radius: 3px;padding: 3px 10px 5px 10px;">
								計畫中
							</span>
						<?php else: ?>
							<span class="label label-success" style="border-radius: 3px;padding: 3px 10px 5px 10px;">
								公開
							</span>
						<?php endif; ?>
					</td> -->
					<td><?php echo e($Course->class_date); ?><br><?php echo e($Course->class_start_time); ?>~<?php echo e($Course->class_end_time); ?></td>
					<td><?php echo e($Course->county); ?><?php echo e($Course->district); ?><?php echo e($Course->addr); ?><?php echo e($Course->zipcode); ?></td>
					<!-- <td><?php echo e($Course->content); ?></td> -->
					<td><?php echo e($Course->quota); ?></td>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      	</table>
        
				<?php echo e($CoursePaginate->links()); ?>

      </div>
    </div>
		
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/class/classList.blade.php ENDPATH**/ ?>