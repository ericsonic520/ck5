<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<!-- <h1><?php echo e($title); ?></h1> -->

	
	<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="card">
      <div class="card-header">
        <h3 class="card-title">
        	<?php echo e($title); ?>

        	<a href="/class/export">
				<button class="btn btn-primary"><i class="fas fa-file-export"></i></button>
			</a>
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
        <table class="table table-bordered">
        	<tbody class="text-center">
        	<tr>
				<th>ID</th>
				<th style="width:8%">名稱</th>
				<th>相關圖片</th>
				<?php if(Auth::user()->type=='A'): ?>
				<th style="width:10%">顯示</th>
				<?php endif; ?>
				<th>日期</th>
				<th style="width:10%">地點</th>
				<!-- <th style="width:7%">課程介紹</th> -->
				<th style="width:8%">名額</th>
				<th style="width:20%">操作</th>
			</tr>
      		<?php $__currentLoopData = $CoursePaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<?php if($Course->status == 'R' && Auth::user()->type=='G'): ?>
				<?php else: ?>
				<td><?php echo e($Course->id); ?></td>
				<td><?php if($Course->category=='C'): ?>
						<?php echo e($Course->name); ?>

					<?php endif; ?>
					<?php if($Course->category=='E'): ?>
						<?php echo e($Course->name); ?>

					<?php endif; ?>
					<?php if($Course->category=='M'): ?>
						<?php echo e($Course->name); ?>

					<?php endif; ?>
				</td>
				<td>
					<?php if(!is_null($Course->pic)): ?>
					<img src="<?php echo e($Course->pic); ?>">
					<?php endif; ?>
					<?php if(is_null($Course->pic)): ?>
					<img src="<?php echo e('/images/class/5d109e473d17b.jpg'); ?>">
					<?php endif; ?>
				</td>
				<?php if(Auth::user()->type=='A'): ?>
				<td>
					<?php if($Course->status == 'R'): ?>
					<span class="label label-default" style="border-radius: 3px;padding: 5px;">
						隱藏
					</span>
					<?php else: ?>
					<span class="label label-success" style="border-radius: 3px;padding: 5px;">
						顯示
					</span>
					<?php endif; ?>
				</td>
				<?php endif; ?>
				<td><?php echo e($Course->class_date); ?><br><?php echo e($Course->class_start_time); ?>~<?php echo e($Course->class_end_time); ?></td>
				<td><?php echo e($Course->county); ?><?php echo e($Course->district); ?><?php echo e($Course->addr); ?><?php echo e($Course->zipcode); ?></td>
				<!-- <td><?php echo e($Course->content); ?></td> -->
				<td><?php echo e($Course->quota); ?></td>
				<td>
					<?php if(auth()->guard()->guest()): ?>
					<?php else: ?> 
						<?php if(Auth::user()->type=='A'): ?>
							<a href="/class/<?php echo e($Course->id); ?>/export">
								<button class="btn btn-primary"><i class="fas fa-file-export"></i></button>
							</a>
							<a href="/class/<?php echo e($Course->id); ?>/edit">
								<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
							</a>
							<a href="/class/<?php echo e($Course->id); ?>/list">
								<button class="btn btn-success"><i class="fas fa-list-ul"></i></button>
							</a>
							<!--<a href="/warning">
								<button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
							</a>-->
							<a href="/class/<?php echo e($Course->id); ?>/del" onclick="javascript:return del();">
								<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
							</a>
						<?php else: ?>
							<a href="/class/<?php echo e($Course->id); ?>/export">
								<button class="btn btn-primary"><i class="fas fa-file-export"></i></button>
							</a>
							<a href="/class/<?php echo e($Course->id); ?>/list">
								<button class="btn btn-success"><i class="fas fa-list-ul"></i></button>
							</a>
						<?php endif; ?>
					<?php endif; ?>	
				</td>
				<?php endif; ?>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		    </table>
		    
			<?php echo e($CoursePaginate->links()); ?>

      </div>
		</div>
	</div>
	<script language="javascript">  
		function del() {
			var msg = "您真的確定要刪除嗎？\n\n請確認！";
			if (confirm(msg)==true){
				return true;
			}else{
				return false;
			}
		}
	</script>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/class/classManage.blade.php ENDPATH**/ ?>