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
						<th>NO.</th>
						<th>姓名</th>
						<th>信箱</th>
						<th>類別</th>
						<th>操作</th>
					</tr>
					<?php $__currentLoopData = $UserPaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $User): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($key+1); ?></td>
						<td><?php echo e($User->name); ?></td>
						<td><?php echo e($User->email); ?></td>
						<td><?php if($User->type=='A'): ?>
								管理員
							<?php else: ?>
								一般使用者
							<?php endif; ?>
						</td>
						<td>
							<?php if(Auth::user()->type=='A'): ?>
							<a href="/user/auth/<?php echo e($User->id); ?>/edit" style="color: white">
								<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
							</a>
							<a href="/user/auth/<?php echo e($User->id); ?>/del" onclick="javascript:return del();">
								<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
							</a>
							<?php else: ?>
							<a href="/user/auth/<?php echo e($User->id); ?>/edit" style="color: white">
								<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
							</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			
			<?php echo e($UserPaginate->links()); ?>

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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/auth/userList.blade.php ENDPATH**/ ?>