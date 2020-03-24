const backToTop = document.querySelector('.back-to-top .fa');
const aboutTitle = document.querySelector('#about_content_titre');
const aboutPhoto = document.querySelector('#about_content_photo');
const navHome = document.querySelector('.background_header');
const navBase = document.querySelector('.background_head');
console.log(navBase)
/* Ouverture du menu Burger */
function openNav() {
    document.getElementById("myNav").style.width = "100%";
    navHome.style.display="none";
    navBase.style.display="none";
  }
  
  /* ferme l'overlay */
  function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    navHome.style.display='block';
  }


  var height = window.innerHeight;
  window.addEventListener('scroll', function(e) {
    // back to top
    if (window.scrollY > 100) {
      backToTop.style.visibility = "visible";
    } else { 
      backToTop.style.visibility = "hidden";
    }

    // About content
    if (window.scrollY > 400) {
      aboutTitle.style.visibility = "visible";
      aboutTitle.classList.add('about_content_titre');
      aboutPhoto.style.visibility = "visible";
      aboutPhoto.classList.add('about_content_photo');
    }
    //sticky header Home
    if(window.scrollY > height) {
      navHome.style.width = "100%";
      navHome.style.height = "100px";
      navHome.style.background = "var(--color-violet)";
      navHome.style.boxShadow = "0 1px 30px rgb(77, 77, 77)";
    }
    if(window.scrollY < height) {
      navHome.style.background="none";
      navHome.style.boxShadow = "none";
    }
  

  });


// ---------------------- PRESTATIONS FILTRES ---------------------------

  // les boutons des catégories .card ouvrent un volet avec les informations complémentaires

  const btnFiltre = document.querySelectorAll('.card');
  const details = document.querySelectorAll('.details');
  
  for ( let i = 0 ; i < btnFiltre.length; i++) {
    btnFiltre[i].addEventListener('click', clicBtn);
  }
  
  
  details[0].style.display = 'block';
  btnFiltre[0].classList.add('violet');
  
  // fonction qui affiche le détail désiré 
  
  
  function hideDetails () {
    for (detail of details){
      detail.style.display = 'none';
      for(btn of btnFiltre){
        btn.classList.remove('violet');
      }
    }
  }
  
  function clicBtn (){
    hideDetails();
    let monIndex = this.dataset.index;
    console.log(monIndex)
    details[monIndex].style.display ='block';
    for(btn of btnFiltre){
      btn.classList.remove('violet');
    }
    this.classList.add('violet');
    
  }
  
  
  //je referme le detail cliqué
  
  const closeBtns = document.querySelectorAll('.details-content .fa');
  
  for (let close of closeBtns){
    close.addEventListener('click', closeBtn);
    
  }
  
  function closeBtn () {
    hideDetails();
    this.classeList.remove('violet');
  }

// ---------------------- PORTFOLIO ---------------------------


$(document).ready(function(){
  $('#myModal').modal(options)
});
