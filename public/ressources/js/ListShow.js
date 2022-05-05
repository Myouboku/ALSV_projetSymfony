
const ListShow = (() => {
  const BtnEntreprise = document.getElementById("btnEntreprise");
  const BtnUser = document.getElementById("btnUser");
  const  BtnTutor = document.getElementById("btnTuteur");
  
  const Entreprise = document.getElementById("entreprise");
  const User = document.getElementById("utilisateur");
  const Tuteur = document.getElementById("tuteur");

  BtnEntreprise.addEventListener("click", (() => {
    Entreprise.style.display = "block";
    User.style.display = "none";
    Tuteur.style.display = "none";
  }));
  
  BtnUser.addEventListener("click", (() => {
    Entreprise.style.display = "none";
    User.style.display = "block";
    Tuteur.style.display = "none";
  }));

  BtnTutor.addEventListener("click", (() => {
    Entreprise.style.display = "none";
    User.style.display = "none";
    Tuteur.style.display = "block";
  }));
})

