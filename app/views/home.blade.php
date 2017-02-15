@extends('temple.layout')

@section('title', 'Trang chủ')


@section('content')
<p>Chào bạn<br/>
Bạn đang truy cập vào hệ thống nhận diện số điện thoại từ comment và message facebook. Bạn có thể sử dụng hệ thống để tự động bắt các số điện thoại mỗi khi có ai đó comment hay nhắn tin trên page do bạn sở hữu<br/>Tất cả thông tin sẽ được lưu trữ an toàn trên Google Drive của chính bạn dưới dạng Google Sheet. Hệ thống hoạt động liên tục, chạy theo thời gian thực và tuyệt đối không thu thập thông tin khách hàng của bạn<br/>
Để sử dụng được hệ thống, bạn cần đăng ký với quản trị viên, bấm vào nút dưới để đăng nhập
</p>
<a href="/user">
	<div class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-right"></span> Vào khu vực thành viên
	</div>
</a>


@endsection