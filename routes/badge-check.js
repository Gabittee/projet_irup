const express = require('express');
const router = express.Router();
const Eleve = require('../models/Eleve');

router.post('/check', async (req, res) => {
  let badgeid = req.body.badgeid;

  // Vérifier si l'entrée est vide
  if (!badgeid) {
    return res.status(400).send('Pas d\'id renseigné');
  }

  // Vérifier si l'entrée est une chaîne de caractères unique
  if (typeof badgeid === 'string') {
    badgeid = [badgeid];
  }

  // Vérifier si l'entrée est un tableau
  if (Array.isArray(badgeid)) {
    let validBadges = [];
    let invalidBadges = [];

    for (let i = 0; i < badgeid.length; i++) {
      const badge = await Eleve.findOne({ badgeid: badgeid[i] });
      if (badge) {
        validBadges.push(badgeid[i]);
      } else {
        invalidBadges.push(badgeid[i]);
      }
    }

    if (validBadges.length === 0) {
      return res.status(404).send('Aucun badge valide trouvé');
    }

    validBadges.forEach(badgeid => {
      res.write(`Badge ${badgeid} valide\n`);
    });

    if (invalidBadges.length > 0) {
      invalidBadges.forEach(badgeid => {
        res.write(`Badge ${badgeid} invalide\n`);
      });
    }

    return res.status(200).end();
  } else {
    // L'entrée n'est pas une chaîne de caractères unique ni un tableau
    const badge = await Eleve.findOne({ badgeid: badgeid });
    if (!badge) {
      return res.status(404).send('Badge non trouvé');
    }

    return res.status(200).send('Badge valide');
  }
});

router.get('/list', async (req, res) => {
  const badges = await Eleve.find({ badgeid: { $exists: true } }).select('Nom badgeid');
  return res.send(badges);
});

 

  

module.exports = router;
