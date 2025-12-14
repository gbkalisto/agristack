<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $tenant->name }} - Official Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        header { background-color: #333; color: #fff; padding: 20px; text-align: center; }
        nav a { color: #fff; margin: 0 10px; text-decoration: none; }
        main { padding: 20px; text-align: center; }
        footer { background-color: #333; color: #fff; padding: 10px; text-align: center; position: fixed; width: 100%; bottom: 0; }
    </style>
</head>
<body>

<header>
    <h1>{{ $tenant->name }}</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/about">About Us</a>
        <a href="/courses">Courses</a>
        <a href="/contact">Contact</a>
        <a href="/login">Login</a>
    </nav>
</header>

<main>
    <h2>Welcome to {{ $tenant->name }}</h2>
    <p>Your journey to excellence in education starts here!</p>
    <img src="https://via.placeholder.com/800x300?text={{ urlencode($tenant->name) }}" alt="{{ $tenant->name }} Banner" style="width:100%; max-width:800px; margin-top:20px;">
</main>

<footer>
    &copy; {{ date('Y') }} {{ $tenant->name }}. All rights reserved.
</footer>

</body>
</html>
