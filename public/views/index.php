<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/app.css">
    <title>Document</title>
</head>

<body>
    <div class="wrapper">
        <div class="notification">
            <h3>Link Copied</h3>
        </div>
    </div>
    <section class="hero">
        <div class="hero-content">
            <h1>Url Shortener</h1>
            <p>paste the link you want to Shorten in the space provided below</p>
            <div class="link-input">
                <form action="" method="post">
                    <input type="url" name="" id="" placeholder="Enter your link">
                    <button type="submit">Shorten</button>
                </form>
            </div>
            <div class="link-input">
                <form action="" method="post">
                    <input type="url" name="" id="short_link" placeholder="Shortened link will appear here" value="test" disabled>
                    <button type="button" class="copyBtn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-copy">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 9.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667l0 -8.666" />
                            <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                        </svg></button>
                </form>
            </div>
        </div>
    </section>
    <footer>

        <p>&copy; 2026 . developed by <a href="https://github.com/timilehin-code">Timi</a>.</p>
    </footer>
    <script src="public/assets/js/app.js"></script>
</body>

</html>