<html>
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="{{ asset('style.css') }}" type="text/css"
</head>

<body >
<div class="wrapper">
		<p class="message"><?php echo $message??"" ?></p>
		<h1><?php echo "Welcome" ??"" ?></h1>
		<ul class="menu">
			<li><a href="">Quản lý danh mục</a></li>
			<li><a href="">Quản lý sản phẩm</a></li>
			<li><a href="">Quản lý người dùng</a></li>
			<li><a href="">Quản lý đơn hàng</a></li>
		</ul>
		
	</div>
	
</body>

</html>