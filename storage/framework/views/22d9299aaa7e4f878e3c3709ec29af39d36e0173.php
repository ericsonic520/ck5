<!-- 指定繼承 layout.master 母模板 -->


<!-- 傳送資料到母模板，並指定變數為 title -->
<?php $__env->startSection('title', $title); ?>

<!-- 傳送資料到母模板，並指定變數為 content -->
<?php $__env->startSection('content'); ?>
<link href="/summernote/summernote.min.css" rel="stylesheet">
    <script src="/summernote/summernote.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="container">
	<!-- <h1><?php echo e($title); ?></h1> -->

	
	<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
              <a href="/news/manageMenu"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
				      <button type="button" class="btn btn-primary" title="<?php echo e($title); ?>"><?php echo e($title); ?></button>
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
            <form action="/news/<?php echo e($menu_id); ?>/menuEditDeal" method="post" enctype="multipart/form-data">

              
              <?php echo e(method_field('PUT')); ?>


              <div class="container">
                <div class="form-group col-md-3">
                    <label for="menu_api">選單API:</label>
                    <input class="form-control" type="text" name="menu_api" value="<?php echo e(old('menu_api', $MenuPaginate[0]->menu_api)); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="menu_name">選單名稱:</label>
                    <input class="form-control" type="text" name="menu_name" value="<?php echo e(old('menu_name', $MenuPaginate[0]->menu_name)); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="menu_caption">選單標題:</label>
                    <input class="form-control" type="text" name="menu_caption" value="<?php echo e(old('menu_caption', $MenuPaginate[0]->menu_caption)); ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="menu_description">選單內容:</label>
                    <textarea id="summernote" name="menu_description"><?php echo $MenuPaginate[0]->menu_description; ?></textarea>
                </div>
              </div>
          
            <button type="submit" class="btn btn-success">更新</button>
            
            <?php echo e(csrf_field()); ?>

          </form>
        </div>
        <script type="text/javascript">
                $(document).ready(function() {
                    $('#summernote').summernote({
                        styleTags: [
            'p',
                { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
                'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],
        
                        // fontNames: ['Arial', 'Arial Black'],
                        // lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                        height: 400,
                        toolbar: [
                            // [groupName, [list of button]]
                            ['style', ['style','bold', 'italic', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            // ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'video']],
                            ['view', ['fullscreen', 'codeview', 'help']],
                            ['height', ['height']]
                        ]
                    })
                });
            </script>
          <!-- /.card-body -->
          <!-- <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div> -->
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/news/newsMenuEdit.blade.php ENDPATH**/ ?>