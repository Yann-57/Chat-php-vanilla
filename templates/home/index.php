<?php $this->title = "Accueil" ?>
<h1 class="mainTitle">Bienvenue à toi jeune entrepreneur</h1>
<?php if(isset($errorMsg)) echo $errorMsg?> 
<div class="overlay d-none"></div>

<form class="d-none modal--login" method="post" action="/home/login" >
    <button class="closeLogin" type="button">&times;</button>
    <h2 class="form__title">Connexion</h2>
    <input class='login--input' type="text" placeholder="Nom d'utilisateur" required name="user[username]">
    <input class='password--input' type="password" placeholder="mot de passe" required name="user[password]">
    <button class="button login--btn" type="submit" value="login">Login</button>
</form>

<form class="modal--createAccount d-none" method="post" action="/home/createUser" enctype="multipart/form-data">
    <button class="closeCreateAccount" type="button">&times;</button>
    <h2 class="form__title">Inscription</h1>  
    <div class="form__field">
        <label class="form__label" for="createUser[username]">Nom d'utilisateur :</label>
        <input class="form__input"type="text" required name="createUser[username]">
    </div>
    <div class="form__field">
        <label class="form__label" for="createUser[password]">Mot de passe :</label>
        <input class="form__input" type="password" required name="createUser[password]">
    </div>
    <div class="form__field">
        <label class="form__label"for="createUser[email]">Email :</label>
        <input class="form__input" type="text" required name="createUser[email]">
    </div>
    <div class="form__field">
        <label class="form__label" for="avatar">Avatar :</label>
        <input class="form__input input--file" type="file" required name="avatar">
    </div>
    <button class="button" type="submit" value="ajouter">Ajouter</button>
</form>