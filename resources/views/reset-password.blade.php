<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>Password Reset Page</h2>

    @if(session('status') == 'success')
    <div class="success-message">
        {{ session('message') }}
    </div>
    @endif

    <form action="{{ route('reset.password') }}" method="post">
        @csrf
        <input type="hidden" name="email" value="{{ request('email') }}">
        <label for="password">New Password:</label>
        <input type="password" name="password" required>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
        <button type="submit">Reset Password</button>
    </form>
</body>

</html>
