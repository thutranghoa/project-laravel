<!-- @extends ('myview')
@section('title', 'Thêm người dùng mới') -->
<html>
    <body>
        <h2> Thêm người dùng mới </h2>
        <form name = 'insertform' action = {{route( 'news.insert' )}} method = 'post'>
            @csrf
            Tiêu đề : <input type = 'text' name = 'name' /> <br>
            Tác giả : <input type = 'text' name = 'author' /> <br>
            Mô tả : <textarea name = 'description' ></textarea> 
            <br>
            <input type = 'submit' value = 'Them' />

        </form>
        
    <body>
</html>

<!-- @endsection -->