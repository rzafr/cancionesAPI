// Generamos las rutas

// Importamos la dependencia express que es el motor del servidor
const express = require('express');

// Importamos el controlador para pasarle los metodos
const SongController = require('../controllers/song');

// Inicializamos el sistema de rutas para pasarle los metodos get, post, put o delete
const api = express.Router(); 

// Middleware
const md_auth = require("../middleware/authenticated");

// Endpoints -----------------------------------------------------------------------

// Agrega una nueva cancion a la BD
api.post("/song", [md_auth.ensureAuth], SongController.createSong);

// Devuelve todas las canciones de la BD en formato JSON
api.get("/song", [md_auth.ensureAuth], SongController.getSongs);

// Muestra en formato JSON la cancion con el id dado
api.get("/song/:id", [md_auth.ensureAuth], SongController.getSong); 

// Muestra las primeras 10 canciones ordenadas por mayor puntuacion en orden descendente
api.get("/song/ranking/toprated", [md_auth.ensureAuth], SongController.getSongsTopRated);

// Muestra todas las canciones de un genero musical en formato JSON
api.get("/song/genre/:genre", [md_auth.ensureAuth], SongController.getSongsGenre);

// Suma a la cancion del id una nueva valoracion que vaya en formato JSON en el body de la request
api.put("/song/:id", [md_auth.ensureAuth], SongController.updateSong);

// Borra la cancion con ese id
api.delete("/song/:id", [md_auth.ensureAuth], SongController.deleteSong);


module.exports = api;