<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')

<div class="container">

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
            <form action=/user/auth/{{ $User->id }}" method="post" enctype="multipart/form-data">

				{{-- 隱藏方法欄位 --}}
				{{ method_field('PUT') }}

				<div class="form-group col-md-3">
					<label for="name">姓名:</label>
					<input type="text" class="form-control" name="name" placeholder="姓名" value="{{ old('name', $User->name) }}">
				</div>

				<div class="form-group col-md-3">
					<label for="email">信箱:</label>
					<input type="text" class="form-control" name="email" placeholder="姓名" value="{{ old('email', $User->email) }}">
				</div>

				<div class="form-group col-md-3">
					<label for="type">類別:</label>
		             <select class="form-control" name="type" id="type">
		                <option value="A" @if(old('type', $User->type)=='A') selected @endif>
		                    管理者(Admin)
		                </option>
		                <option value="G" @if(old('type', $User->type)=='G') selected @endif>
		                    一般使用者(General)
		                </option>
		            </select>
				</div>

				<div class="form-group col-md-3">
					<label for="email">密碼:</label>
					<input id="AnswerBox" type="password" class="form-control" name="password" placeholder="密碼" value="{{ old('password', $User->password) }}">
					<div class="custom-control custom-checkbox col-md-5 align-middle">
						<input type="checkbox" class="custom-control-input" id="chkPasw">
						<label class="custom-control-label" for="chkPasw"><span style="font-size:smaller;font-weight:900">顯示密碼</span></label>
					</div>
				</div>

				<button type="submit" class="btn btn-success">更新</button>
				{{-- CSRF 欄位 --}}
				{{ csrf_field() }}
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
@endsection