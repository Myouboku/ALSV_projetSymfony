const affichageAjout = (() => {
  // Liste des boutons d'ajout
  const BtnAddEntreprise = document.getElementById('addEntr');
  const BtnAddUser = document.getElementById('addUser');
  const BtnAddTutor = document.getElementById('addTuteur');
  // Liste des boutons d'édition
  const BtneditEntreprise = document.getElementById('editEntr');
  const BtneditUser = document.getElementById('editUser');
  const BtneditTutor = document.getElementById('editTuteur');
  // Liste des divs à afficher
  const ADDTuteur = document.getElementById('ajoutTuteur');
  const ADDUser = document.getElementById('ajoutUser');
  const ADDEntr = document.getElementById('ajoutEntr');

  
BtnAddEntreprise.addEventListener('click', (() => {
  // On affiche les divs Entreprise
  ADDEntr.style.display = "block";
}));

BtnAddUser.addEventListener('click', (() => {
  // On affiche les divs User
  ADDUser.style.display = "block";
}));

BtnAddTutor.addEventListener('click', (() => {
  // On affiche les divs Tuteur
  ADDTuteur.style.display = "block";
}));

BtneditEntreprise.addEventListener('click', (() => {
  // On affiche les divs Entreprise
  ADDEntr.style.display = "block";    
}));

BtneditUser.addEventListener('click', (() => {
  // On affiche les divs User
  ADDUser.style.display = "block";
}));

BtneditTutor.addEventListener('click', (() => {
  // On affiche les divs Tuteur
  ADDTuteur.style.display = "block";
}));
})

