@extends('temple.layout')

@section('title', 'User info')


@section('content')
@if($user->isAdmin)
 Chào {{$user->name}}<br/>
<a href="/admin">
<div class="btn btn-primary">
	<span class="glyphicon glyphicon-user"></span> Admin
</div></a>


@endif


<a href="{{$facebookRefreshPageUrl}}">
<div class="btn btn-info">
	<span class="glyphicon glyphicon-refresh"></span> Tải lại danh sách page facebook
</div></a>
@if($googleOauthUrl != '')
<a href="{{$googleOauthUrl}}">
<div class="btn btn-danger">
	<span class="glyphicon glyphicon-export"></span> Cấp quyền truy cập Google
</div></a>
@else
<div class="btn btn-success">
<span class="glyphicon glyphicon-ok"></span> Đã cấp quyền truy cập Google thành công
</div>

@endif
<a href="/user/logout">
<div class="btn btn-danger"><span class="glyphicon glyphicon-off"></span> Đăng xuất</div>
</a>
<a href="/">
<div class="btn btn-success">
<span class="glyphicon glyphicon-home"></span> Trang chủ
</div>
</a>

@if($googleOauthUrl != '')

<div class="panel panel-danger">
      <div class="panel-heading">Thông báo</div>
      <div class="panel-body">Bấm nút "Cấp quyền truy cập Google" (bên trên) để hệ thống có thể gửi dữ liệu theo dõi được lên tài khoản Google của bạn</div>
    </div>



@endif




@if(count($pages)>0)
<table class="table table-striped table-bordered">
<thead><tr><th>Tên page</th><th>Hành động</th></tr></thead>
<tbody>
@foreach($pages as $p)
<tr>
	<td style="vertical-align: middle; text-align: center">{{$p->name}}</td>
	<td>
	@if($googleOauthUrl == '')
	
	@if($p->active==1)
		<a href="user/delPage?pid={{$p->pid}}">
			<div class="btn btn-danger">
			<span class="glyphicon glyphicon-eye-close"></span> Tắt theo dõi (hiện tại đang bật)</div>
		</a>
	@else
		<a href="user/addPage?pid={{$p->pid}}">
			<div class="btn btn-success">
			<span class="glyphicon glyphicon-eye-open"></span> Bật theo dõi (hiện tại đang tắt)</div>
		</a>
	@endif
	@endif
		<a href="http://fb.com/{{$p->pid}}" target="_blank">
			<div class="btn btn-info">
			<span class="glyphicon glyphicon-send"></span> Xem page</div>
		</a>
	
	@if($p->sheetId != '')
		<a href="https://docs.google.com/spreadsheets/d/{{$p->sheetId}}/edit#gid=0" target="_blank">
			
			<div class="btn btn-primary">
			<span class="glyphicon glyphicon-paperclip"></span> Mở sheet theo dõi</div>
			
		</a>
	@endif
	
			<div class="btn btn-danger delete-button" data-pid="{{$p->pid}}" data-pname="{{$p->name}}">
			<span class="glyphicon glyphicon-remove"></span> Xóa page</div>
	</td>


</tr>
@endforeach
</tbody>
</table>
@else
<div class="panel panel-warning">
<div class="panel-heading">Thông báo</div>
<div class="panel-body">Hệ thống chưa nhận diện được page nào, bạn bấm nút tải lại danh sách page facebook ở trên để thử lại nhé!</div>
</div>



@endif
<script>
	$(".delete-button").bind('click', function(){
		var pid  = $(this).data('pid');
		var name = $(this).data('pname');
		var sure = confirm('Xóa page "'+name+'" nghĩa là page này sẽ không còn được cập nhật và không xuất hiện trong danh sách nữa. File lưu trữ vẫn sẽ được giữ nguyên, an toàn trên Google Drive của bạn. Bạn chắc chứ?');
		if(sure)
		{
			window.location = '/user/forceDelPage?pid='+pid;
		}
	})
	
	
	
</script>



@endsection