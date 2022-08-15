<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<br><br><br>
<div class="container">

    <form action="{{ route('search') }}" method="get">
        <input type="text" name="search" class="form-control">
        <button type="submit" class="btn">search</button>
    </form>
    <a href="{{ route('user.create') }}">Add</a>
    <table class="table table-hover">
        <thead>
            <th>stt</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th colspan="2">thao tác</th>
        </thead>
        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <form action="{{ route('user.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('ban co muon xoa khong?')">Delete</button>
                        </form>
                        |
                        <a href="{{ route('user.edit', $item->id) }}">edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table><br>
    <a href="{{ route('onlyTrashed') }}">Dữ liệu vừa xóa</a>
    {{ $user->links() }}
</div>
