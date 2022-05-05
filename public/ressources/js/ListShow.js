
const ListShow = (() => {
  const BtnEntreprise = document.getElementById("btnEntreprise");
  const BtnUser = document.getElementById("btnUser");
  const  BtnTutor = document.getElementById("btnTuteur");
 
  
  const Entreprise = document.getElementById("entreprise");
  const addEntr = document.getElementById("ajoutEntr");
  const User = document.getElementById("utilisateur");
  const ADDUser = document.getElementById("ajoutUser");
  const Tuteur = document.getElementById("tuteur");
  const ADDTuteur = document.getElementById('ajoutTuteur');

  BtnEntreprise.addEventListener("click", (() => {
    // On affiche les divs Entreprise
    Entreprise.style.display = "block";
    addEntr.style.display = "none";
    User.style.display = "none";
    Tuteur.style.display = "none";
    
  }));
  
  BtnUser.addEventListener("click", (() => {
    Entreprise.style.display = "none";
    User.style.display = "block";
    ADDUser.style.display = "none";
    Tuteur.style.display = "none";
  }));

  BtnTutor.addEventListener("click", (() => {
    Entreprise.style.display = "none";
    User.style.display = "none";
    Tuteur.style.display = "block";
    ADDTuteur.style.display = "none";
  }));
})

