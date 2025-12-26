<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $service = strip_tags(trim($_POST["service"]));
    $message = strip_tags(trim($_POST["message"]));

    // Vérification simple
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Merci de remplir correctement le formulaire.";
        exit;
    }

    // Destinataire (votre email o2switch)
    $to = "contact@cleanmax-3f.fr"; // Remplacez par votre email réel

    // Sujet de l'email
    $subject = "Nouveau message depuis le site CLEANMAX 3F";

    // Contenu de l'email
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Téléphone: $phone\n";
    $email_content .= "Service: $service\n";
    $email_content .= "Message:\n$message\n";

    // En-têtes de l'email
    $headers = "From: $name <$email>";

    // Envoi de l'email
    if (mail($to, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Message envoyé avec succès !";
    } else {
        http_response_code(500);
        echo "Une erreur est survenue. Veuillez réessayer plus tard.";
    }

} else {
    http_response_code(403);
    echo "Méthode non autorisée";
}
?>
