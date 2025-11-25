<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Envoi d'un fichier</title>
<style>
/* --- STYLE POPUP --- */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.5);
  display: none;
  justify-content: center;
  align-items: center;
}

.popup {
  background: white;
  padding: 20px;
  border-radius: 15px;
  width: 300px;
  animation: zoomIn 0.4s ease forwards;
}

@keyframes zoomIn {
  from {
    transform: scale(0.5);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}

/* --- STYLE NOTIFICATION --- */
#notification {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #4caf50;
  color: white;
  padding: 15px 20px;
  border-radius: 10px;
  display: none;
  box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
</style>
</head>
<body>

<h2>Envoi d'un fichier</h2>

<form id="uploadForm" enctype="multipart/form-data">
  <label for="formFile">Sélectionne un fichier :</label><br><br>
  <input type="file" id="formFile" name="fichier" required><br><br>
  <button type="submit">Envoyer</button>
</form>

<!-- POPUP PUBLICITÉ -->
<div class="popup-overlay" id="popup">
  <div class="popup">
    <h3>Fichier envoyé ! 😄</h3>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPIZAqQm8tskoTOfM2f9P-kJ8mcdAxWUtMbg&s" style="width:100%;border-radius:10px;" />
    <br><br>
    <button onclick="fermerPopup()">Fermer</button>
  </div>
</div>


<script>
const form = document.getElementById("uploadForm");
const notification = document.getElementById("notification");

form.addEventListener("submit", function(e) {
    e.preventDefault(); // Empêche le rechargement de la page
    ouvrirPopup();

    const formData = new FormData(form);
    fetch("upload.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        showNotification(data); // Affiche le message de notification
    })
    .catch(error => {
        showNotification("Erreur lors de l'envoi du fichier !");
        console.error("Erreur :", error);
    });
});

function ouvrirPopup(){
  document.getElementById("popup").style.display = "flex";
}

function fermerPopup(){
  document.getElementById("popup").style.display = "none";
}

</script>

</body>
</html>
