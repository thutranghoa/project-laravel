<html>
    <body>
        <h2> Chỉnh sửa người dùng </h2>
        <form name='editform' action={{ route('news.edit', ['id' => $news->id]) }} method='post'>
            @csrf
            <input type = 'hidden' name = 'id' value = '{{$news->id}}' />
            Tiêu đề : <input type = 'text' name = 'name' value = '{{$news->name}}' /> <br>
            Tác giả : <input type = 'text' name = 'author' value = '{{$news->author}}' /> <br>
            Mô tả : <textarea name = 'description' >{{$news->description}}</textarea> 
            <br>
            <input type = 'submit' value = 'Sửa' />
        
    <body>
</html>