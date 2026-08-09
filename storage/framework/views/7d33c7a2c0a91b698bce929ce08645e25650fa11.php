<!-- 指定繼承 layout.master 母模板 -->


<!-- 傳送資料到母模板，並指定變數為 title -->
<?php $__env->startSection('title', $title); ?>

<!-- 傳送資料到母模板，並指定變數為 content -->
<?php $__env->startSection('content'); ?>

<div class="container">

	
	<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="card card-default">
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
            <form action=/user/auth/<?php echo e($User->id); ?>" method="post" enctype="multipart/form-data">

				
				<?php echo e(method_field('PUT')); ?>


				<div class="form-group col-md-3">
					<label for="name">姓名:</label>
					<input type="text" class="form-control" name="name" placeholder="姓名" value="<?php echo e(old('name', $User->name)); ?>">
				</div>

				<div class="form-group col-md-3">
					<label for="email">信箱:</label>
					<input type="text" class="form-control" name="email" placeholder="姓名" value="<?php echo e(old('email', $User->email)); ?>">
				</div>

				<div class="form-group col-md-3">
					<label for="type">類別:</label>
		             <select class="form-control" name="type" id="type">
		                <option value="A" <?php if(old('type', $User->type)=='A'): ?> selected <?php endif; ?>>
		                    管理者(Admin)
		                </option>
		                <option value="G" <?php if(old('type', $User->type)=='G'): ?> selected <?php endif; ?>>
		                    一般使用者(General)
		                </option>
		            </select>
				</div>

				<div class="form-group col-md-3">
					<label for="email">密碼:</label>
					<input id="AnswerBox" type="password" class="form-control" name="password" placeholder="密碼" value="<?php echo e(old('password', $User->password)); ?>">
					<div class="custom-control custom-checkbox col-md-5 align-middle">
						<input type="checkbox" class="custom-control-input" id="chkPasw">
						<label class="custom-control-label" for="chkPasw"><span style="font-size:smaller;font-weight:900">顯示密碼</span></label>
					</div>
				</div>

				<button type="submit" class="btn btn-success">更新</button>
				
				<?php echo e(csrf_field()); ?>

	        </form>
		</div>
    </div>
    <script type="text/javascript">
		$(document).ready(function () {   
			//ShowHidePasw();//一進來先隱藏密碼
			$('#chkPasw').attr('onclick', 'ShowHidePasw()');
								   
		});
		//密碼顯示或是隱藏
		function ShowHidePasw() {
			var txtPasw = $("#AnswerBox");
			//alert(txtPasw.attr("type"));
			if (txtPasw.attr("type") == "text") {
				txtPasw.attr("type", "password");
			}
			else {
				txtPasw.attr("type", "text");

			}
			
		}
	</script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/auth/memberUp.blade.php ENDPATH**/ ?>