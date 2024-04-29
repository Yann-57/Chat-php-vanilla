<?php $this->title = 'Dashboard' ?>
<h1 class="mainTitle">Salons Disponibles</h1>
<div class="rooms__grid">
<?php foreach($rooms as $key => $room): ?>
    <div class="rooms__card"><a href="/chat/room/<?= $room->id() ?>"><?= $room->name()?></a></div>
<?php endforeach; ?>
</div>
