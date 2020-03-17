
/* Ouverture du menu Burger */
function openNav() {
    document.getElementById("myNav").style.width = "100%";
  }
  
  /* ferme l'overlay */
  function closeNav() {
    document.getElementById("myNav").style.width = "0%";
  }

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

  