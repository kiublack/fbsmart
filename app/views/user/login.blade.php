


@extends('temple.layout')

@section('title', 'User info')


@section('content')
Chào bạn, để đăng nhập vào phần quản lý của hệ thống. Bạn vui lòng bấm nút dưới đây để xác thực qua facebook<br/>
<a href="{{$loginUrl}}">
	
	<div class="btn btn-primary">
		
			<span class="glyphicon glyphicon-lock"></span> Đăng nhập bằng facebook
	</div>
</a>


@endsection