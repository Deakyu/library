
<!doctype HTML>

<html lang="en">
<head>
  <meta charset="utf-8">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/sidebar.css">
  <title>Library</title>
</head>

<body>
    <nav id="navbar">
        <ul>
            <li><a href="/">Hala's Libraries</a></li>
            <li> <?php if(isset($_SESSION['user'])) echo $_SESSION['user']['is_admin'] ? "<a href='/admin/user-index.php'>Admin</a>" : "<a href='/all-libraries.php'>Libraries</a>" ?></li>
            <?php echo $_SESSION['login-status'] ? "<li> </li>" : "" ?>
            <?php echo $_SESSION['login-status'] ? "<li>" . $_SESSION['user']['username'] . "</li>" : '' ?>
            <?php echo $_SESSION['login-status'] ? "<li><a href='/logout.php'>Logout</a></li>" : "<li> </li>" ?>
            <?php echo $_SESSION['login-status'] ? "" : "<li><a href='/login.php'>Login</a></li>" ?>
            <?php echo $_SESSION['login-status'] ? "" : "<li><a href='/register.php'>Register</a></li>" ?>
        </ul>
    </nav>
