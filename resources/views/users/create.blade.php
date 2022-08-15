<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<div class="container">
    @if ($errors->any)
        @foreach ($errors->all() as $item)
           <li><span>{{ $item }}</span></li> 
        @endforeach
    @endif
    <form action="{{ route('user.store') }}" class="form" method="post">
        @csrf
        <label for="">Họ và Tên</label>
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" value="{{old('email')}}">
        <label for="">Mật Khẩu</label>
        <input type="password" name="password" class="form-control">
        <label for="">Nhập lại mật khẩu</label>
        <input type="password" name="re_password" class="form-control">
        <button class="btn btn-primary">Add</button>
    </form>
</div>
