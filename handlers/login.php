<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo(get_setting("site.title")); ?></title>
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
    <h1>Login at <?php echo(get_setting("site.title")); ?>!</h1>

    <input type="text" id="username">
    <input type="password" id="password">
    <button onclick="login()">Login</button>

    <?php include_once("rpcclient.php"); ?>
    <script>
        function login() {
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            rpc('v1.auth.login', { username, password })
               .then(r => {
                    console.log("Logged in:", r);
                    window.location.href = "/";
                })
               .catch(err => {
                    console.error("Login error:", err);
                    alert("Invalid username or password");
                });
        }
    </script>
</body>
</html>