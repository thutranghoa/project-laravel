<!DOCTYPE html>
<html>
<head>
    <title>Sửa Dữ Liệu Học Sinh</title>
</head>
<body>
    <h1>Sửa Dữ Liệu Học Sinh</h1>
    <form action="{{ route('suadulieu.post', $student->id) }}" method="POST">
        @csrf
        <label for="ten">Tên:</label>
        <input type="text" id="ten" name="ten" value="{{ $student->ten }}"><br><br>

        <label for="img">Hình ảnh:</label>
        <input type="text" id="img" name="img" value="{{ $student->img }}"><br><br>

        <label for="gmail">Gmail:</label>
        <input type="text" id="gmail" name="gmail" value="{{ $student->gmail }}"><br><br>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
