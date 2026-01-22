<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include 'config/conn.php';
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$baseUrl = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
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
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
            </svg>
            <h3>Link Copied</h3>
        </div>
    </div>
    <section class="hero">
        <div class="hero-content">
            <h1>Url Shortener</h1>
            <p>paste the link you want to Shorten in the space provided below</p>
            <div class="link-input">
                <form action="controllers/Shortner/shortner.php" method="post">
                    <input type="url" name="original_url" id="" placeholder="Enter your link">
                    <button type="submit">Shorten</button>
                </form>
            </div>
            <div class="link-input">
                <input type="url" style="background-color:white;" name="" id="short_link" placeholder="Shortened link will appear here" value="<?php echo $baseUrl . $_SESSION['short_code'] ?>" disabled>
                <button type="button" style="margin-left: 5px;" class="copyBtn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-copy">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 9.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667l0 -8.666" />
                        <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" />
                    </svg></button>
            </div>
        </div>
    </section>
    <footer>

        <p>&copy; 2026 | developed by <a href="https://github.com/timilehin-code">Timi</a>.</p>
    </footer>
    <script src="public/assets/js/app.js"></script>
</body>

</html>