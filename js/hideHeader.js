const menu = document.getElementById('menu');
const header = document.getElementById('aside');
const mainSection = document.querySelector('main');

menu.onclick = addClass;

menu.addEventListener('touchmove', addClass);

function addClass() {
  header.classList.toggle('hide');
  menu.classList.toggle('showing');
  mainSection.classList.toggle('expand');
}
