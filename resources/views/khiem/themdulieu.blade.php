<!DOCTYPE html>
<html>
<head>
    <title>Tạo danh mục mới</title>
</head>
<body>
    <h2><a href="{{route('showdata.get')}}">Trang chủ</a></h2>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('themdulieu.post') }}" method="POST">
        @csrf
        <label for="ten">Ten:</label>
        <input type="text" id="username" name="ten" required>
        <br>
        <label for="pass">img:</label>
        <input type="text" id="pass" name="img" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="gmail" required>
        <br>
        <button type="submit">Tạo danh mục</button>
    </form>
</body>
</html>
