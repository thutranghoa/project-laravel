<DOCTYPE html>
<html>

<head>
    <title>{{ $data['title'] }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <table>
        <tr> 
            <td>
                <h1>Verify Your Email Address</h1>
                <p>Thanks for creating an account.
                    Please follow the link below to verify your email address
                </p>
                <a href="{{ $data['url] }}">Verify Email</a>
            </td>
        </tr>
    </table>
</body>

</html>