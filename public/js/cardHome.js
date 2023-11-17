// Sélectionnez tous les éléments de classe "card"
const cards = document.querySelectorAll('.card');

// Ajoutez un événement de survol à chaque carte
cards.forEach(card => {
  card.addEventListener('mouseenter', () => {
    // Appliquez l'animation au survol
    card.classList.add('card-hover');
  });

  card.addEventListener('mouseleave', () => {
    // Supprimez l'animation lorsque le curseur quitte la carte
    card.classList.remove('card-hover');
  });
});



document.getElementById('registration-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the default form submission

  // Perform additional validation or AJAX submission if needed
  // You can access form data using JavaScript DOM API

  // Example AJAX submission using Fetch API
  var formData = new FormData(this);
  fetch(this.action, {
      method: this.method,
      body: formData
  })
  .then(function(response) {
      // Handle the response from the server
  })
  .catch(function(error) {
      // Handle any error that occurred during the request
  });
});