// Liste des images à afficher en arrière-plan
const images = [
    "image1.jpg",
    "image2.jpg",
    "image3.jpg",
    "image4.jpg",
    "image5.jpg",
  ];

  let currentIndex = 0; // Index de l'image actuelle
  const background = document.querySelector(".background");

  function changeBackground() {
    // Mettre à jour l'image en background
    background.style.backgroundImage = `url(${images[currentIndex]})`;

    // Passer à l'image suivante
    currentIndex = (currentIndex + 1) % images.length; // Boucler les images

    // Reprogrammer le changement toutes les 4 secondes
    setTimeout(changeBackground, 4000);
  }

  // Initialiser le background à la première image
  changeBackground();