<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Ozrit</title>
</head>
<body>
    <h2>Welcome to Ozrit, {{ $user->name }}!</h2>
    <p>You have successfully registered.</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Password:</strong> {{ $user->password_plain }}</p> <!-- Send only for first-time registration -->
    <p>Login here: <a href="{{ url('/login') }}">Ozrit Login</a></p>
</body>
</html>
