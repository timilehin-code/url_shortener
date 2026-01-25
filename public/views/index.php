<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include 'config/conn.php';
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$baseUrl = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$shortcode = $_SESSION['short_code'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Free URL shortener. Create short links instantly, track clicks, and share easily. No account required.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo $baseUrl; ?>">

    <meta property="og:title" content="URL Shortener - Timi's Tool">
    <meta property="og:description" content="Paste any long link and get a short, beautiful version in seconds. Free & fast.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $baseUrl; ?>">
    <meta property="og:site_name" content="Timi URL Shortener">


    <meta property="og:image" content="<?php echo $baseUrl; ?>public/assets/img/image.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="URL Shortener preview - short links made easy">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="URL Shortener - Timi's Tool">
    <meta name="twitter:description" content="Create short, trackable links instantly. Free forever.">
    <meta name="twitter:image" content="<?php echo $baseUrl; ?>public/assets/img/image.png">
    <meta name="twitter:site" content="@Timilehin_26">
    <meta name="twitter:creator" content="@Timilehin_26">

    <meta property="og:image:secure_url" content="<?php echo $baseUrl; ?>public/assets/img/image.png">
    <meta property="og:image:type" content="image/jpeg">

    <link rel="stylesheet" href="public/assets/css/app.css">
    <title>URL Shortener - Create short, clean links</title>

</head>

<body>
    <?php
    if (isset($_SESSION['error'])) {
    ?>
        <div class="wrapper">
            <div class="notification-error active">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-xbox-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10m3.6 5.2a1 1 0 0 0 -1.4 .2l-2.2 2.933l-2.2 -2.933a1 1 0 1 0 -1.6 1.2l2.55 3.4l-2.55 3.4a1 1 0 1 0 1.6 1.2l2.2 -2.933l2.2 2.933a1 1 0 0 0 1.6 -1.2l-2.55 -3.4l2.55 -3.4a1 1 0 0 0 -.2 -1.4" />
                </svg>
                <h3><?= $_SESSION['error'] ?></h3>
            </div>
        </div>
    <?php
    }
    unset($_SESSION['error']);
    ?>
    <?php
    if (isset($_SESSION['success'])) {
    ?>
        <div class="wrapper">
            <div class="notification-success active">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                </svg>
                <h3><?= $_SESSION['success'] ?></h3>
            </div>
        </div>
    <?php
    }
    unset($_SESSION['success']);
    ?>
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
                <input type="url" style="background-color:white; color:green;" name="" id="short_link" placeholder="Shortened link will appear here" value="<?php echo $baseUrl . $shortcode ?>" disabled>
                <button type="button" style="margin-left: 5px;" class="copyBtn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-copy">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 9.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667l0 -8.665z" />
                        <path d="M4.012 15.339a1.9999999999999998e-15 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 .5 " />
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