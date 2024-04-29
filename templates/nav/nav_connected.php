<nav class='navbar'>
    <span class='navbar__left'>Session de <?= $_SESSION['currentUser']->username()?></span>
    <h2 class="navbar__middle"><?= $title ?></h2>
    <div class="navbar__right">
        <a class="btn--disconnect button" href="/home">Se Deconnecter</a>
    </div>
</nav>