@extends('layout.master')
@section('title', $title)
@section('content')
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	@include('components.validationErrorMessage')
	
	<div class="card">
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
			<table class="table table-bordered">
				<tbody class="text-center">
					<tr>
						<th>NO.</th>
						<th>姓名</th>
						<th>信箱</th>
						<th>類別</th>
						<th>操作</th>
					</tr>
					@foreach($UserPaginate as $key=> $User)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $User->name }}</td>
						<td>{{ $User->email }}</td>
						<td>@if($User->type=='A')
								管理員
							@else($User->type=='G')
								一般使用者
							@endif
						</td>
						<td>
							@if(Auth::user()->type=='A')
							<a href="/user/auth/{{ $User->id }}/edit" style="color: white">
								<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
							</a>
							<a href="/user/auth/{{ $User->id }}/del" onclick="javascript:return del();">
								<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
							</a>
							@else
							<a href="/user/auth/{{ $User->id }}/edit" style="color: white">
								<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
							</a>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{-- 分頁頁數按鈕 --}}
			{{ $UserPaginate->links() }}
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
@endsection