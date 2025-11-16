const menuBtn=document.getElementById('menu-btn');
const menu=document.getElementById('menu');
const overlay=document.getElementById('overlay');
const icon=menuBtn.querySelector('i');

menuBtn.addEventListener('click',()=>{
  menu.classList.toggle('active');
  overlay.classList.toggle('active');
  menuBtn.classList.toggle('active');

  if(menu.classList.contains('active')) icon.classList.replace('fa-bars', 'fa-xmark');
  else icon.classList.replace('fa-xmark', 'fa-bars');
});

overlay.addEventListener('click', ()=>{
  menu.classList.remove('active');
  overlay.classList.remove('active');
  menuBtn.classList.remove('active');
  icon.classList.replace('fa-xmark', 'fa-bars');
});