"use strict";

const btnConnection = document.querySelector(".btn--connect");
const btnDisconnection = document.querySelector(".btn--disconnect");
const btnCreateAccount = document.querySelector(".btn--createAccount");
const modalCreateAccount = document.querySelector(".modal--createAccount");
const modalLogin = document.querySelector(".modal--login");
const closeLogin = document.querySelector(".closeLogin");
const closeCreateAccount = document.querySelector(".closeCreateAccount");
const overlay = document.querySelector(".overlay");
const chatWall = document.querySelector(".chat__wall");
const btnCreateRoom = document.querySelector(".btn--createRoom");
const modalCreateRoom = document.querySelector(".modal--createRoom");
const closeCreateRoom = document.querySelector(".closeCreateRoom");

// PERMET D'AFFICHER AUTOMATIQUEMENT LES DERNIERS MESSAGES (ALLER EN BAS DU SCROLL)
if (chatWall) {
  chatWall.scrollTop = chatWall.scrollHeight;
}

function closeModal(elt) {
  elt.classList.add("d-none");
  overlay.classList.add("d-none");
}

function openModal(elt) {
  elt.classList.remove("d-none");
  overlay.classList.remove("d-none");
}

function activateModal(buttonOpen, buttonClose, block) {
  buttonOpen.addEventListener("click", openModal.bind(this, block));
  buttonClose.addEventListener("click", closeModal.bind(this, block));
  overlay.addEventListener("click", closeModal.bind(this, block));
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && !block.classList.contains("d-none"))
      closeModal(block);
  });
}

if (modalLogin) {
  activateModal(btnConnection, closeLogin, modalLogin);
}

if (modalCreateAccount) {
  activateModal(btnCreateAccount, closeCreateAccount, modalCreateAccount);
}

if (modalCreateRoom) {
  activateModal(btnCreateRoom, closeCreateRoom, modalCreateRoom);
}
