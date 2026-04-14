<?php
$file = 'data.json';

// Si on reçoit des données (POST), on écrase le fichier JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('php://input');
    if ($data) {
        file_put_contents($file, $data);
        echo json_encode(["status" => "success"]);
    }
} 
// Sinon (GET), on lit le fichier JSON pour l'envoyer au navigateur
else {
    if (!file_exists($file)) {
        // Valeurs par défaut si le fichier n'existe pas encore
        $initial = [
            "stocks" => [
                "Théo 1" => 20, "Théo 2" => 20, "Théo 3" => 20, "Théo 4" => 20,
                "Master Théo" => 15, "Philo 1" => 25, "Philo 2" => 20, "Philo 3" => 20, "Master Philo" => 15
            ],
            "historique" => []
        ];
        file_put_contents($file, json_encode($initial));
    }
    header('Content-Type: application/json');
    echo file_get_contents($file);
}
?>