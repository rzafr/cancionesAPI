const mongoose = require("mongoose");

// Esquema de la collecion en Mongo
const Schema = mongoose.Schema;

const UserSchema = Schema({
    name: {
        type: String,
        require: false
    },
    lastname: {
        type: String,
        require: false
    },
    email: {
        type: String,
        require: true,
        unique: true
    },
    password: {
        type: String,
        require: true
    }
});

module.exports = mongoose.model("User", UserSchema);