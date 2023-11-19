window.addEventListener('load', function() {
  const cards = document.querySelectorAll('.card');
  let maxHeight = 0;

  // Ajoutez un événement de survol à chaque carte et trouvez la hauteur maximale
  cards.forEach(card => {
      card.addEventListener('mouseenter', () => {
          card.classList.add('card-hover');
      });

      card.addEventListener('mouseleave', () => {
          card.classList.remove('card-hover');
      });

      if (card.offsetHeight > maxHeight) {
          maxHeight = card.offsetHeight;
      }
  });

  // Appliquez la hauteur maximale à toutes les cartes
  cards.forEach(card => {
      card.style.height = maxHeight + 'px';
  });

  // Autre code, par exemple pour le formulaire
  const form = document.getElementById('registration-form');
  if(form){
      form.addEventListener('submit', function(event) {
          event.preventDefault();
          // Reste du code pour la gestion du formulaire
      });
  }
});
