
function ListShow() {
  let BtnEntreprise = document.getElementById("btnEntreprise");
  let BtnUser = document.getElementById("btnUser");
  let BtnTutor = document.getElementById("btnTuteur");
  
  let Entreprise = document.getElementById("entreprise");
  let User = document.getElementById("utilisateur");
  let Tuteur = document.getElementById("tuteur");

  BtnEntreprise.addEventListener("click", function(){
    Entreprise.style.display = "block";
    User.style.display = "none";
    Tuteur.style.display = "none";
  });
  
  BtnUser.addEventListener("click", function(){
    Entreprise.style.display = "none";
    User.style.display = "block";
    Tuteur.style.display = "none";
  });

  BtnTutor.addEventListener("click", function(){
    Entreprise.style.display = "none";
    User.style.display = "none";
    Tuteur.style.display = "block";
  });
}

