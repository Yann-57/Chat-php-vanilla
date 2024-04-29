<?php $this->title = $currentRoom->name()?>
<div class="chat">
    <div class="chat__rooms">
        <h2>Salons</h2>
        <?php foreach($rooms as $_ => $room) : ?>
            <div class="chat__rooms--card"><a href="/chat/room/<?= $room->id() ?>"><?= $room->name()?></a></div>
        <?php endforeach ; ?>
        <button class="button btn--createRoom">Créer un salon</button> 
        <div class="overlay d-none"></div>
        <form class="d-none modal--createRoom" method="post" action="/chat/newRoom">
            <button class="closeCreateRoom" type="button">&times;</button>
            <h2 class="form__title">Créer un salon</h2>
            <input class='form__input' type="text" placeholder="Nom du Salon" required name="roomName">
            <button class="button btn--newRoom" type="submit" value="newRoom">Créer</button>
        </form>
        
    </div>
    <div class="chat__wall">
    <?php if(!empty($messages)){
        foreach($messages as $key => $message): ?>
            <div class="message">
                <img class="avatar" src="<?= $message->avatar()?>" alt="avatar de <?= $message->username()?>">
                <h2 class="username"><?= ucfirst($message->username())?></h2>
                <span class='date'><?= $message->date_posted()?></span>
                <p class="content"><?= $message->content()?></p>
            </div>
    <?php endforeach; } ?>
    </div>
    <div class="chat__form">
        <form class='envoi' action="/chat/send/<?= $currentRoom->id() ?>" method="post" enctype="multipart/form-data">
            <h3>Ecrivez votre message</h3>
            <textarea class="chat--input" type="text" name="send[content]"></textarea>
            <button class="button send--btn "type="submit">Envoyer</button>
            <span class="error"></span>
        </form>
        <a class="button refresh--btn" href="/chat/room/<?= $currentRoom->id()  ?>">Actualiser</a>
    </div>  
</div>
<script>  
const form = document.querySelector('.envoi');
const url = form.action;
const input = document.querySelector('.chat--input');
const wall = document.querySelector('.chat__wall');
const error = document.querySelector('.error');

//  FONCTION ASYNCHRONE ATTENDANT UN OBJET DE TYPE FORMDATA
async function postData(formattedFormData){

// AWAIT PERMET DE GENERER UNE LOGIQUE D'ETAPES DANS UNE FONCTION ASYNCHRONE
// TANT QUE LA REPONSE N'EST PAS RECU, LE SCRIPT NE CONTINUE PAS    
const response = await fetch(url, {
    method: 'POST',
    body: formattedFormData
});

// ON TRANSFORME LA REPONSE EN FORMAT JSON
const data = await response.json();

// ON RECUPERE LES DONNEES ENVOYES POUR LES INTEGRER DANS LE DOM
let html = '';
            data.forEach(message => {
                html += `<div class="message">
                <img class="avatar" src="${message.avatar}" alt="avatar de ${message.username}">
                <h2 class="username">${message.username}</h2>
                <span class='date'>${message.date_posted}</span>
                <p class="content">${message.content}</p>
            </div>`
            })
            wall.innerHTML = html;
            // ON AMENE L'UTILISATEUR AU DERNIER MESSAGE SUR L'INTERFACE
            chatWall.scrollTop = chatWall.scrollHeight

}

// ON AJOUTE UN ECOUTEUR D'EVENEMENT SUR L'ENVOI DU FORMULAIRE 
form.addEventListener('submit', function(event){
    //PERMET DE STOPPER L'ENVOI DU FORMULAIRE
    event.preventDefault();
    // SI UNE VALEUR EST ENTREE DANS LE CHAMPS
    if(input.value){
        error.textContent = ''
        // ON CREER UN OBJET FORMDATA QUI NOUS PERMET DE RECUPERER LES DONNES DE NOTRE FORMULAIRE PHP 
        const formattedFormData = new FormData(form);
        postData(formattedFormData);
        // ON REMET LA VALEUR A 0
        input.value = '';
    }
    else error.textContent = 'Vous ne pouvez pas envoyer un message vide';
});

// FUNCTION PERMETTANT DE RECUPER TOUT LES MESSAGES D'UN SALON ET DE LES INTEGRER DANS LE DOM
async function getData(){
    const response = await fetch(url).then(response => response.json().then(data => {
        message = data;
        let html = '';
            data.forEach(message => {
                html += `<div class="message">
                <img class="avatar" src="${message.avatar}" alt="avatar de ${message.username}">
                <h2 class="username">${message.username}</h2>
                <span class='date'>${message.date_posted}</span>
                <p class="content">${message.content}</p>
            </div>`
            })
            wall.innerHTML = html;
            chatWall.scrollTop = chatWall.scrollHeight
    }))
}

// ON RECUPERER LES MESSAGES TOUTE LES 3 SECONDES
setInterval(getData, 3000);

</script>