const express = require("express");
const UserController = require("../controllers/user")
const api = express.Router();

// Endpoints ----------------------------------------------------------

// Registra usuario
api.post("/user", UserController.register);

// Login de usuario. Devuelve un token para hacer las llamadas a la API
api.post("/login", UserController.login);


module.exports = api;