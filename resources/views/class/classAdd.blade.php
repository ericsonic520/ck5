<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')

<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
	          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
	            <i class="fas fa-minus"></i></button>
	          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	            <i class="fas fa-times"></i></button>
	        </div> 
        </div>
          <!-- /.card-header -->
        <div class="card-body">
            <form action="/class/adl" method="post" enctype="multipart/form-data">

				{{-- 隱藏方法欄位 --}}
				{{ method_field('PUT') }}

				<div class="form-group col-md-3">
					<label for="category">類別:</label>
					<select class="form-control" name="category" id="category">
						<option value="E">
							英文
						</option>
						<option value="C">
							國文
						</option>
						<option value="M">
							數學
						</option>
					</select>
				</div>

				<div class="form-group col-md-3">
					<label for="status">狀態:</label>
					
					<select class="form-control" name="status" id="status">
						<option value="P">
							顯示
						</option>
						<option value="R">
							隱藏
						</option>
					</select>
				</div>

				<div class="form-group col-md-3">
					<label for="name">名稱:</label>
					<input type="text" class="form-control" name="name" placeholder="名稱" value="">
				</div>

				<div class="form-group col-md-3">
					<label for="pic">圖片:</label>
					<input id="pic" type="file" name="pic" placeholder="圖片" value="">
				</div>

				<div class="form-group col-md-3 input-append date form_datetime">
					<label for="pic">課程日期:</label>
					<input type="text" name="class_date" value="" class="form-control" placeholder="課程日期">
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
					<label for="class_start_time">開始時間:</label>
					<input id="class_start_time" class="form-control" type="time" name="class_start_time" placeholder="課程開始時間" value="">
				</div>

				<div class="form-group col-md-3">
					<label for="class_end_time">結束時間:</label>
					<input id="class_end_time" class="form-control" type="time" name="class_end_time" placeholder="課程結束時間" value="">
				</div>

				<div class="form-group col-md-3">
					<label for="class_end_time">名額:</label>
					<input id="quota" class="form-control" type="number" name="quota" placeholder="名額" value="" min="0">
				</div>

				<div class="form-group col-md-12">
					<label for="addr">地址:</label>				
					<div id="addr"></div>
					<input id="addr" class="form-control col-md-8" type="input" name="addr" placeholder="地址" value="">

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
					<textarea id="content" class="form-control" type="text" name="content" placeholder="介紹" value=""></textarea>
					
				</div>

				<input id="quota_last" class="form-control" type="hidden" name="quota_last" placeholder="名額" value="">
				<button type="submit" class="btn btn-success">新增</button>
				{{-- CSRF 欄位 --}}
				{{ csrf_field() }}
			</form>
		</div>
          <!-- /.card-body -->
          <!-- <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div> -->
    </div>

</div>
@endsection