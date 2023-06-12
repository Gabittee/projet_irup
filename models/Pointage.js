const mongoose = require("mongoose");

const pointageModel = mongoose.Schema({
    titre: {
        type: String,
        required: true,
    },
    auteur: {
        type: String,
        required: true,
    },
    datePublication: {
        type: Date,
        required: true,
    },
});

module.exports = mongoose.model("Pointage", pointageModel, "Pointage");
