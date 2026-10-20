


<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - IT Student Portal</title>
</head>
<body><h1>IT Student Portal</h1>

<h2>Welcome, {{ auth()->user()->name }}!</h2>

<p>Email: {{ auth()->user()->email }}</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit">Logout</button>
</form>

</body>
</html>
