<!-- resources/views/students/showdata.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Show Students Data</title>
</head>
<body>
    <h3><a href='{{route('themdulieu.get')}}'>thêm dữ liệu</a></h3>
    <h1>Danh sách học sinh</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>link ảnh</th>
                <th>Gmail</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->ten }}</td>
                    <td>{{ $student->img }}</td>
                    <td>{{ $student->gmail }}</td>
                    <td ><a href="{{ route('suadulieu.get', $student->id) }}">Sửa</a></td>
                    <td>
                        <form action="{{ route('xoadulieu.post', $student->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa học sinh này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
