const toggleButton = document.getElementsByClassName('toggle-button')[0]                            /* Tableau de tous les élémnets enfants qui ont la classe toggle-button. Ici à l'indice 0  */
const navbarLinks = document.getElementsByClassName('navbar-links')[0]     

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')    /* Si la classe n'existe pas, elle sera ajoutée, sinon elle sera supprimée  */
})




