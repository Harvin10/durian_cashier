<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/sales.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <section class="header"></section>
        <section class="main">
            <form action="verification.php" method="post">
                <div class="input">
                    <label>
                        Username:
                        <input type="text" name="username">
                    </label>
                    <label>
                        password:
                        <input type="password" name="password">
                    </label>
                </div>
                <button type="submit" name="submit">login</button>
            </form>
        </section>
    </div>
</body>

</html>