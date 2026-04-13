const express = require('express');
const fs = require('fs');
const app = express();
app.use(express.json());
app.use(express.static('public')); // Sert les fichiers HTML/PWA

const DB_FILE = './repas.json';

app.post('/api/repas', (req, res) => {
    const nouveauRepas = req.body;

    // Lecture du fichier existant
    fs.readFile(DB_FILE, (err, data) => {
        let json = [];
        if (!err) json = JSON.parse(data);

        // Ajout du nouveau repas
        json.push(nouveauRepas);

        // Écriture
        fs.writeFile(DB_FILE, JSON.stringify(json, null, 2), (err) => {
            if (err) return res.status(500).send("Erreur écriture");
            res.status(200).send("Ok");
        });
    });
});

app.listen(3000, () => console.log('Serveur lancé sur http://localhost:3000'));