
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
	<!-- <h1><?php echo e($title); ?></h1> -->

	
	<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="card">
			<div class="card-header">
				<!-- <h3 class="card-title"><?php echo e($title); ?></h3> -->
				<a href="/present"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
				<a href="/present/add"><button class="btn btn-success" title="新增履歷"><i class="fas fa-solid fa-plus"></i></button></a>
				<button type="button" class="btn btn-primary" title="<?php echo e($title); ?>"><?php echo e($title); ?></button>
				
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
				</div>
			</div>
			<?php 
				$user = session('user_data'); 
			?>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered">
					<tbody class="text-center">
						<tr>
						<th>ID</th>
						<th>履歷名稱</th>
						<th>新增時間</th>
						<th>使用模板</th>
						<th>操作</th>
						</tr>
						<?php $__currentLoopData = $ResumePaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $resume): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($resume->resume_id); ?></td>
							<td><?php echo e($resume->resume_name); ?></td>
							<td><?php echo e($resume->created_at); ?></td>
							<td>
								<form action="/present/<?php echo e($resume->resume_id); ?>/chgResumesDis" enctype="multipart/form-data">
									<?php if($resume->resume_display=='1'): ?>
										<button method="submit" class="btn btn-success" title="顯示"><i class="far fa-solid fa-eye"></i></button>
									<?php endif; ?>
									<?php if($resume->resume_display=='0'): ?>
										<button method="submit" class="btn btn-warning" title="隱藏"><i class="fas fa-solid fa-eye-slash"></i></button>
									<?php endif; ?>
									<input type="hidden" name="resume_display" value="<?php echo e($resume->resume_display); ?>">
								</form> 
								<!-- <a href="/present/<?php echo e($resume->resume_id); ?>/chgResumesDis">
								<button class="btn btn-success"><i class="far fa-eye"></i></button>
								</a> -->
							</td>
							<td>
								<?php if(auth()->guard()->guest()): ?>
								<?php else: ?> 
									<?php if(Auth::user()->type=='A'): ?>
										
										
										<a href="/present/<?php echo e($resume->resume_id); ?>/edit">
										<button class="btn btn-primary" title="更新履歷"><i class="fas fa-edit"></i></button>
										</a>
										<!--<a href="/warning">
										<button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
										</a>-->
										<!-- <a href="/present/<?php echo e($resume->resume_id); ?>/del" onclick="javascript:return del();">
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
				
				<?php echo e($ResumePaginate->links()); ?>

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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/present/resumeManage.blade.php ENDPATH**/ ?>