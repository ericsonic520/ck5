<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
	<!-- <h1><?php echo e($title); ?></h1> -->

	
	<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="card">
			<div class="card-header">
				<!-- <h3 class="card-title"><?php echo e($title); ?></h3> -->
				<a href="/site/manage"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
				<a href="/news/addcarousel">
					<button class="btn btn-success" title="新增輪播"><i class="fas fa-solid fa-plus"></i></button>
				</a>
				<button type="button" class="btn btn-info" title="<?php echo e($title); ?>"><?php echo e($title); ?></button>
				
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered">
					<tbody class="text-center">
						<tr>
							<th>ID</th>
							<th>輪播名稱</th>
							<th>輪播說明</th>
							<th>輪播圖片</th>
							<th>是否檢視</th>
							<th>操作</th>
						</tr>
						<?php $__currentLoopData = $CarouselPaginate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($carousel->carousel_id); ?></td>
							<td><?php echo e($carousel->carousel_title); ?></td>
							<td><?php echo e($carousel->carousel_description); ?></td>
							<td style='width:20vw'><img style='inline-size: inherit;' src="<?php echo e(asset($carousel->carousel_image)); ?>" alt="<?php echo e($carousel->carousel_description); ?>" title="<?php echo e($carousel->carousel_description); ?>"></td>
							<td>
								<form action="/news/<?php echo e($carousel->carousel_id); ?>/chgcarouseldis" enctype="multipart/form-data">
									<?php if($carousel->carousel_display=='1'): ?>
									<button method="submit" class="btn btn-success" title="顯示"><i class="far fa-eye"></i></button>
									<?php endif; ?>
									<?php if($carousel->carousel_display=='0'): ?>
									<button method="submit" class="btn btn-warning" title="隱藏"><i class="fas fa-solid fa-eye-slash"></i></button>
									<?php endif; ?>
									<input type="hidden" name="carousel_display" value="<?php echo e($carousel->carousel_display); ?>">
									<input type="hidden" name="carousel_id" value="<?php echo e($carousel->carousel_id); ?>">
								</form> 
							</td>
							<td>
								<?php if(auth()->guard()->guest()): ?>
								<?php else: ?> 
									<?php if(Auth::user()->type=='A'): ?>
										<!-- <a href="/news/<?php echo e($carousel->carousel_id); ?>/itm">
											<button class="btn btn-success"><i class="far fa-eye"></i></button>
										</a> -->
										<a href="/news/<?php echo e($carousel->carousel_id); ?>/carouselEdit">
											<button class="btn btn-primary" title="更新內容"><i class="fas fa-edit"></i></button>
										</a>
										<!--<a href="/warning">
										<button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
										</a>-->
										<!-- <a href="/news/<?php echo e($carousel->carousel_id); ?>/del" onclick="javascript:return del();">
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
				
				<?php echo e($CarouselPaginate->links()); ?>

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
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/news/newsCarouselManage.blade.php ENDPATH**/ ?>