@extends('layout.master')
@section('title', $title)
@section('content')
<style>
	/* 定義閃爍動畫 */
@keyframes border-pulse {
  0%, 100% {
    background-color: #fef08a; /* 淺黃 */
    box-shadow: inset 0 0 0 2px #eab308, 0 0 8px rgba(234, 179, 8, 0.8);
  }
  50% {
    background-color: #fef9c3; /* 極淺黃 */
    box-shadow: inset 0 0 0 2px transparent, 0 0 0px transparent;
  }
}

/* 警示樣式類別 */
.blink-warning {
  animation: border-pulse 1.2s infinite ease-in-out;
  color: #854d0e;
  font-weight: bold;
  padding: 8px 12px;
  text-align: center;
}
</style>
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
		<div class="card">
			<div class="card-header">
				<!-- <h3 class="card-title">{{ $title }}</h3> -->
				<a href="/present"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
				<a href="/present/add"><button class="btn btn-success" title="新增履歷"><i class="fas fa-solid fa-plus"></i></button></a>
				<button type="button" class="btn btn-primary" title="{{ $title }}">{{ $title }}</button>
				
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
				</div>
			</div>
			@php 
				$user = session('user_data'); 
			@endphp
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered">
					<tbody class="text-center">
						<tr>
						<th>ID</th>
						<th>履歷名稱</th>
						<th>新增時間</th>
						@if($hasDisplay=='true')<th>使用模板</th>@else <th style="background-color:yellow;"  class="blink-warning">↓↓尚未選擇履歷</th>@endif
						<th>操作</th>
						</tr>
						@foreach($ResumePaginate as $key => $resume)
						<tr>
							<td>{{ $resume->resume_id  }}</td>
							<td>{{ $resume->resume_name }}</td>
							<td>{{ $resume->created_at }}</td>
							<td @if(!$hasDisplay=='true')class="blink-warning" style="background-color:yellow;"@endif>
								<form action="/present/{{ $resume->resume_id }}/chgResumesDis" enctype="multipart/form-data">
									@if($resume->resume_display=='1')
										<button method="submit" class="btn btn-success" title="顯示"><i class="far fa-solid fa-eye"></i></button>
									@elseif($resume->resume_display=='0')
										<button method="submit" class="btn btn-warning" title="隱藏"><i class="fas fa-solid fa-eye-slash"></i></button>
									@endif
									<input type="hidden" name="resume_display" value="{{$resume->resume_display}}">
								</form> 
								<!-- <a href="/present/{{ $resume->resume_id }}/chgResumesDis">
								<button class="btn btn-success"><i class="far fa-eye"></i></button>
								</a> -->
							</td>
							<td>
								@guest
								@else 
									@if(Auth::user()->type=='A')
										
										
										<a href="/present/{{ $resume->resume_id }}/edit">
										<button class="btn btn-primary" title="更新履歷"><i class="fas fa-edit"></i></button>
										</a>
										<!--<a href="/warning">
										<button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
										</a>-->
										<!-- <a href="/present/{{ $resume->resume_id }}/del" onclick="javascript:return del();">
										<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
										</a> -->
									@else
									@endif
								@endguest
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{-- 分頁頁數按鈕 --}}
				{{ $ResumePaginate->links() }}
			</div>
		</div>
</div>
<!-- 引入 SweetAlert2 CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
{{-- 檢查 $presents 集合內，resume_display 是否完全沒有 1 --}}
@if(!$presents_all->contains('resume_display', 1))
    <script>
            Swal.fire({
                icon: 'warning',
                title: '尚未設定預設履歷',
                text: '目前沒有任何預設開啟的履歷，點擊開啟一個履歷吧',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '好',
                cancelButtonText: '暫時不要'
            }).then((result) => {
                if (result.isConfirmed) {
                    // 使用者點擊了「是的，開啟此履歷」
                    
                    // 作法 1：如果頁面上剛好有 toggle 按鈕，可以直接觸發 click 事件
                    // if ($('#btnSwitch').length && !$('#btnSwitch').hasClass('active')) {
                    //     $('#btnSwitch').click(); 
                    // }
                    
                    // 作法 2：或者是直接發送 AJAX 請求去後端更新狀態
                    
                    // $.ajax({
                    //     url: '/verifydata3',
                    //     method: 'POST',
                    //     data: {
                    //         _token: '{{ csrf_token() }}',
                    //         id: '{{ $presents[0]->resume_id ?? 1 }}',
                    //         resume_display: 1
                    //     },
                    //     success: function(response) {
                    //         Swal.fire('已開啟！', '此履歷已設定為預設開啟。', 'success')
                    //             .then(() => location.reload());
                    //     }
                    // });
                    
                }
            });
    </script>
@endif 
@endsection