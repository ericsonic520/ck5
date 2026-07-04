<?php if($errors AND count($errors)): ?>
	<div class="cls" role="alert">
		<div class="alert alert-warning">
			<ul>
				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li> <?php echo e($err); ?></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
		</div>
	</div>
	<style type="text/css">
		.cls {
		    -moz-animation: cssAnimation 0s ease-in 5s forwards;
		    /* Firefox */
		    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
		    /* Safari and Chrome */
		    -o-animation: cssAnimation 0s ease-in 5s forwards;
		    /* Opera */
		    animation: cssAnimation 0s ease-in 5s forwards;
		    -webkit-animation-fill-mode: forwards;
		    animation-fill-mode: forwards;

		}
		.alert {
		    position: relative;
		    padding: .75rem 1.25rem;
		    margin-bottom: 1rem;
		    border: 1px solid transparent;
		    border-radius: .55rem;
		}
		@keyframes  cssAnimation {
		    to {
		        width:0;
		        height:0;
		        overflow:hidden;
		    }
		}
		@-webkit-keyframes cssAnimation {
		    to {
		        width:0;
		        height:0;
		        visibility:hidden;
		    }
		}
	</style>
<?php endif; ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/components/validationErrorMessage.blade.php ENDPATH**/ ?>