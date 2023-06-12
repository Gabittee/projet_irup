const mongoose = require("mongoose");

const eleveModel = mongoose.Schema({
    nom: {
        type: String,
        required: true
    },
    prenom: {
        type: String,
        required: true
    },
    age: {
        type: String,
        required : true
    },
    badgeid: {
        type: String,
        required: true
    }
})
module.exports = mongoose.model('Eleve', eleveModel, 'Eleves');