const express = require('express');
const router = express.Router();

const Pointage = require('../models/Pointage');


    router.get('/', async (req, res) => {
        let pointage = await Pointage.find();
        let tableRows = pointage.map((point) => {
          // Supprimez la propriété `_id` de chaque élément
          const { _id, ...rest } = point._doc;
          return Object.values(rest).map((value) => `<td>${value}</td>`).join('');
        })
        .map((row, index) => `<tr><td>${index + 1}</td>${row}</tr>`)
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
                        <th>Pointage</th>
                        <th>Badge de l'élève</th>
                        <th>Eleves</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableRows}
                </tbody>
            </table>
        `);
    });
    
    module.exports = router;
    
    
    
    