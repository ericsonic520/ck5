@extends('layout.master')
@section('title', $title)
@section('content')

<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">
					<a href="/news/managesort"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
              		<button type="button" class="btn btn-info" title="{{ $title }}">{{ $title }}</button>
				</h3>
				
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
						<th>簡介選單</th>
						<th>操作</th>
						</tr>
						@foreach($MenuPaginate as $key => $Menu)
						<tr>
							<td>{{ $Menu->menu_id }}</td>
							<td><a href="/news/{{ $Menu->menu_id }}/itm" style="color: black;text-decoration: none;">{{ $Menu->post_title }}</a></td>
							<td>
								@guest
								@else 
								@if(Auth::user()->type=='A')
									<a href="/news/{{ $Menu->menu_id }}/itm">
									<button class="btn btn-primary"><i class="far fa-eye"></i></button>
									</a>
									<a href="/news/{{ $Menu->menu_id }}/edit">
									<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
									</a>
									<!--<a href="/warning">
									<button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
									</a>-->
									<a href="/news/{{ $Menu->menu_id }}/del" onclick="javascript:return del();">
									<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
									</a>
								@else
								@endif
								@endguest
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{-- 分頁頁數按鈕 --}}
				{{ $PostPaginate->links() }}
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