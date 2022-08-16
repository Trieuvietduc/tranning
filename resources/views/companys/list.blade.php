<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<br><br><br>
<div class="container">
    <form action="" method="get">
        <input type="text" name="search" class="form-control">
        <button class="btn">Search</button>
    </form>
    <table class="table table-hover">
        <thead>
            <th>stt</th>
            <th>mã số</th>
            <th>Họ và tên</th>
            <th>Số điện thoại</th>
            <th>địa chỉ</th>
            <th colspan="2"><a href="{{ route('company.create') }}">Add</a></th>
        </thead>
        <tbody>
            @foreach ($company as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->code }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->telephone }}</td>
                    <td>{{ $value->address }}</td>
                    <td>
                        <form action="{{ route('company.show', $value->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn" onclick="return confirm('bạn chắc chắn muốn xóa')">Del</button>
                        </form>
                        |
                        @if ($value->deleted_at == null)
                            <a href="{{ route('company.edit', $value->id) }}">Edit</a>
                        @else
                            <a href="{{ route('company.restore', $value) }}">khôi phục</a>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($value->deleted_at == null)
        <a href="{{ route('company.onlyTrashed') }}">Dữ liệu vừa xóa</a>
    @else
        <a href="{{ route('company.index') }}">Quay lại</a>
    @endif

</div>
