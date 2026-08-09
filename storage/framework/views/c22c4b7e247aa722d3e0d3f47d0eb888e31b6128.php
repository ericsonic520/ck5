<!-- 指定繼承 layout.master 母模板 -->


<!-- 傳送資料到母模板，並指定變數為 title -->
<?php $__env->startSection('title', $title); ?>

<!-- 傳送資料到母模板，並指定變數為 content -->
<?php $__env->startSection('content'); ?>

<div class="container">
	<!-- <h1><?php echo e($title); ?></h1> -->

	
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
            <form action="/class/<?php echo e($Course->id); ?>" method="post" enctype="multipart/form-data">

          
          <?php echo e(method_field('PUT')); ?>


          <div class="form-group col-md-3">
            <label for="category">類別:</label>
             <select class="form-control" name="category" id="category">
                <option value="E" <?php if(old('category', $Course->category)=='E'): ?> selected <?php endif; ?>>
                    英文
                </option>
                <option value="C" <?php if(old('category', $Course->category)=='C'): ?> selected <?php endif; ?>>
                    國文
                </option>
                <option value="M" <?php if(old('category', $Course->category)=='M'): ?> selected <?php endif; ?>>
                    數學
                </option>
            </select>
          </div>

          <div class="form-group col-md-3">
            <label for="status">狀態:</label>
            <!-- <br>
            <input type="radio" name="status" id="status" value="P" <?php if(old('<?php echo e($Course->status); ?>')): ?> checked <?php endif; ?>> 開放

            <input type="radio" name="status" id="status" value="R"<?php if(!old('<?php echo e($Course->status); ?>')): ?> checked <?php endif; ?>> 計畫中 -->
            <select class="form-control" name="status" id="status">
                            <option value="P" <?php if(old('status', $Course->status)=='P'): ?> selected <?php endif; ?>>
                                開放
                            </option>
                            <option value="R" <?php if(old('status', $Course->status)=='R'): ?> selected <?php endif; ?>>
                                計畫中
                            </option>
                        </select>
          </div>
          
          <div class="form-group col-md-3">
            <label for="name">名稱:</label>
            <input type="text" class="form-control" name="name" placeholder="名稱" value="<?php echo e(old('name', $Course->name)); ?>">
          </div>

          <div class="form-group col-md-3">
            <label for="pic">圖片:</label>
            <input id="pic" type="file" name="pic" placeholder="圖片" value="<?php echo e(old('pic', $Course->pic)); ?>">
            <?php if(!is_null($Course->pic)): ?>
                <img src="<?php echo e($Course->pic); ?>">
            <?php endif; ?>
            <?php if(is_null($Course->pic)): ?>
                <img src="<?php echo e('/images/class/5d109e473d17b.jpg'); ?>">
            <?php endif; ?>
            <!-- <?php if(!is_null($Course->pic)): ?>
                <img src="<?php echo e($Course->pic); ?>">
            <?php else: ?>
                <img src="<?php echo e('images/default-merchandise.png'); ?>">
            <?php endif; ?> -->
          </div>

          <div class="form-group col-md-3 input-append date form_datetime">
            <label for="pic">課程日期:</label>
              <input type="text" name="class_date" value="<?php echo e(old('class_date', $Course->class_date)); ?>" class="form-control" placeholder="課程日期">
              <span class="add-on"></span>
          </div>
           
          <script type="text/javascript">
              $(".form_datetime").datepicker({
                  format: "yyyy-mm-dd",
                autoclose: true,
                startDate: "today",
                clearBtn: true,
                calendarWeeks: true,
                todayHighlight: true,
                language: 'zh-TW'
                });
          </script>  

          <div class="form-group col-md-3">
            <label for="class_start_time">課程開始時間:</label>
            <input id="class_start_time" class="form-control" type="time" name="class_start_time" placeholder="課程開始時間" value="<?php echo e(old('class_start_time', $Course->class_start_time)); ?>">
          </div>
          <!-- <div class="container">
              <div class="row">
                  <div class='col-sm-6'>
                      <div class="form-group">
                          <div class='input-group date' id='datetimepicker3'>
                              <input type='text' class="form-control" />
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-time"></span>
                              </span>
                          </div>
                      </div>
                  </div>
                  <script type="text/javascript">
                      $(function () {
                          $('#datetimepicker3').datetimepicker({
                              format: 'LT'
                          });
                      });
                  </script>
              </div>
          </div> -->

          <div class="form-group col-md-3">
            <label for="class_end_time">課程結束時間:</label>
            <input id="class_end_time" class="form-control" type="time" name="class_end_time" placeholder="課程結束時間" value="<?php echo e(old('class_end_time', $Course->class_end_time)); ?>">
          </div>

          <div class="form-group col-md-3">
            <label for="class_end_time">名額:</label>
            <input id="quota" class="form-control" type="number" name="quota" placeholder="名額" value="<?php echo e(old('quota', $Course->quota)); ?>">
          </div>

          <div class="form-group col-md-12">
            <label for="addr">地址:</label>       
            <div id="addr"></div>
            <input id="addr" class="form-control col-md-8" type="input" name="addr" placeholder="地址" value="<?php echo e(old('addr', $Course->addr)); ?>">
            
            <style type="text/css">
              .county, .district, .zipcode{float: left;}
            </style>
            <script type="text/javascript">
              $(function () {
                  $('#addr').twzipcode({
                      countyName: 'county',
                      districtName: 'district',
                      zipName: 'zipcode',
                        // 依序套用至縣市、鄉鎮市區及郵遞區號框
                    'css': ['county form-control col-md-3', 'district form-control col-md-3', 'zipcode form-control col-md-3']
                  });
              });
            </script>
          </div>

          <div class="form-group col-md-5">
            <label for="content">介紹:</label>
            <textarea id="content" class="form-control" type="text" name="content" placeholder="介紹" value="<?php echo e($Course->content); ?>"><?php echo e($Course->content); ?></textarea>
            <!-- <input type="text" class="form-control" name="text" placeholder="介紹" value="<?php echo e(old('content', $Course->content)); ?>"> -->
          </div>
          <input id="quota_last" class="form-control" type="hidden" name="quota_last" placeholder="名額" value="<?php echo e(old('quota_last', $Course->quota_last)); ?>">
          <button type="submit" class="btn btn-success">更新</button>
          
          <?php echo e(csrf_field()); ?>

        </form>
		</div>
          <!-- /.card-body -->
          <!-- <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div> -->
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/class/classEdit.blade.php ENDPATH**/ ?>