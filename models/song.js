const mongoose = require("mongoose");

// Esquema de la collecion songs en Mongo
const Schema = mongoose.Schema;

const SongSchema = Schema({
    title: {
        type: String,
        require: true
    },
    performer: {
        type: String,
        require: true
    },
    duration: {
        type: Number,
        require: false
    },
    year: {
        type: Number,
        require: false
    },
    genre: {
        type: String,
        require: false
    },
    rate: {
        type: Number,
        require: false
    }
});

module.exports = mongoose.model("Song", SongSchema);
