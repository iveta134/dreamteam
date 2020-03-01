<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li>About</li>
            <li><a href="/index.php?register">Register</a></li>
        </ul>
    </nav>
<?php
if (isset($_SESSION['id'])) {
    ?>
    <a href="logout.php">Logout</a>
<?php
} else {
    ?>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="User" required></input>
        <input type="password" name="pw" placeholder="Password" required></input>
        <label for="rem-chk">Remember Me
        <input type="checkbox" name="rememberMe" id="rem-chk">
        </label>
        <button type="submit" name="loginBtn">LOGIN</button>
    </form>
<?php
}
?>
</header>