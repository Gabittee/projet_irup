const express = require('express');
const router = express.Router();

const Eleve = require('../models/Eleve');

router.get('/', async (req, res) => {
    let eleves = await Eleve.find();
    let tableRows = Object.entries(eleves)
        .map(([key, value]) => {
            // Supprimez la propriété `_id` de chaque élève
            const { _id, ...rest } = value._doc;
            // Créez une chaîne pour chaque élève avec les propriétés restantes
            const row = Object.values(rest).map((val) => `<td>${val}</td>`).join('');
            return `<tr><td>${+key + 1}</td>${row}</tr>`;
        })
        .join('');
    res.send(`
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            table {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                border-collapse: collapse;
            }
            th, td {
                text-align: left;
                padding: 8px 15px;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
        </style>
        <table border="1" cellpadding="50" cellspacing="0">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Promo</th>
                    <th>E-Mail</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>ID Badge</th>
                </tr>
            </thead>
            <tbody>
                ${tableRows}
            </tbody>
        </table>
    `);
});

module.exports = router;




