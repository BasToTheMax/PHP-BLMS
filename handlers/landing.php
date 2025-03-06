<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ name }}</title>
    <link rel="stylesheet" href="/css/v1.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/categories.php">Categories</a></li>
            <li><a href="/books/new.php">New books</a></li>
            <li><a href="/books/all.php">All books</a></li>
        </ul>
    </nav>
    <hr />
    <h1>{{ name }}!</h1>
    <p>Welcome to the {{ name }}! Search and rent books!</p>

    <h2>Categories</h2>
    <ul>
        {{ category.forEach }}
    </ul>

    <h2>New books</h2>
    <ul>
        {{ newBooks.forEach }}
    </ul>
</body>
</html>