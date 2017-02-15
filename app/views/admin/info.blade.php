


@extends('temple.layout')

@section('title', 'Admin')


@section('content')
<a href="/user"><div class="btn btn-success">
	<span class="glyphicon glyphicon-chevron-left"></span> Quay lại
</div></a><br/>
Chào admin, dưới dây là danh sách các user đã được cấp phép truy cập trong hệ thống. Bạn có thể thêm mới người dùng bằng cách yêu cầu họ gửi cho số facebook id và nhập vào ô dưới đây<br/>

<form class="form-inline" role="form" action="admin/add">
    <input type="number" required class="form-control"  placeholder="ID facebook" name="fid">
  <button type="submit" class="btn btn-default">Thêm</button>
</form>
<table class="table table-striped table-bordered">
<thead><tr><th>ID</th><th>Tên</th></thead>
<tbody>
	
	
@foreach($users as $u)
<tr>
	<td>{{$u->fid}}</td>
	<td>
		@if($u->name == '')
		(người này chưa đăng nhập nên chưa rõ tên)
		@else
		{{$u->name}}
		@endif
		
		</td>
</tr>
@endforeach
</tbody>
</table>



@endsection