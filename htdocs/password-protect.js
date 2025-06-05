// Mot de passe haché (SHA-256 du mot de passe correct)
const HASHED_PASSWORD =
  "2ff5f5be79b792535af796d84d65b60f6c670a6811be0b71501cfff2826d33da";

// Fonction pour hacher une entrée avec SHA-256
async function hashPassword(password) {
  const encoder = new TextEncoder();
  const data = encoder.encode(password);
  const hashBuffer = await crypto.subtle.digest("SHA-256", data);
  return Array.from(new Uint8Array(hashBuffer))
    .map((byte) => byte.toString(16).padStart(2, "0"))
    .join("");
}

// Fonction pour demander le mot de passe et vérifier le hash
async function promptPassword() {
  const userPassword = prompt(
    "Veuillez entrer le mot de passe pour accéder à cette page :"
  );

  if (!userPassword) {
    alert("Accès refusé.");
    window.location.href = "https://www.google.com"; // Rediriger en cas d'échec
    return;
  }

  const hashedInput = await hashPassword(userPassword);

  if (hashedInput === HASHED_PASSWORD) {
    alert("Accès autorisé !");
  } else {
    alert("Mot de passe incorrect. Redirection...");
    window.location.href = "https://www.google.com";
  }
}

// Exécuter la fonction au chargement de la page
window.onload = promptPassword;
