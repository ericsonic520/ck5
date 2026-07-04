@extends('layout.master')
@section('title', $title)
@section('content')

<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
		<div class="card">
			<div class="card-header">
				<!-- <h3 class="card-title">{{ $title }}</h3> -->
				<a href="/news"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
				<a href="/news/addMenu"><button class="btn btn-success" title="新增選單"><i class="fas fa-solid fa-plus"></i></button></a>
				<button type="button" class="btn btn-primary" title="{{ $title }}">{{ $title }}</button>
				
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
						<th>選單api</th>
						<th>選單名稱</th>
						<th>選單說明</th>
						<th>是否顯示</th>
						<th>操作</th>
						</tr>
						@foreach($MenuPaginate as $key => $menu)
						<tr>
							<td>{{ $menu->menu_id  }}</td>
							<td>{{ $menu->menu_api }}</td>
							<td>{{ $menu->menu_name }}</td>
							<td>{{ $menu->menu_caption }}</td>
							<td>
								<form action="/news/{{ $menu->menu_id }}/chgmenudis" enctype="multipart/form-data">
									@if($menu->menu_display=='1')
									<button method="submit" class="btn btn-success" title="顯示"><i class="far fa-eye"></i></button>
									@endif
									@if($menu->menu_display=='0')
									<button method="submit" class="btn btn-warning" title="隱藏"><i class="fas fa-solid fa-eye-slash"></i></button>
									@endif
									<input type="hidden" name="menu_display" value="{{ $menu->menu_display }}">
								</form> 
							</td>
							<td>
								@guest
								@else 
									@if(Auth::user()->type=='A')
										<!-- <a href="/news/{{ $menu->menu_id }}/itm">
										<button class="btn btn-primary"><i class="far fa-eye"></i></button>
										</a> -->
										
										<a href="/news/{{ $menu->menu_id }}/menuEdit">
										<button class="btn btn-primary" title="更新內容"><i class="fas fa-edit"></i></button>
										</a>
										<!--<a href="/warning">
										<button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
										</a>-->
										<!-- <a href="/news/{{ $menu->menu_id }}/del" onclick="javascript:return del();">
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
				{{ $MenuPaginate->links() }}
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