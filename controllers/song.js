const { restart } = require("nodemon");
const Song = require("../models/song");

/**
 * Inserta una cancion nueva en MongoDB
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function createSong(req, res) {
    const song = new Song();

    // Parametros que llegan por request con el POST
    const params = req.body;

    // Los datos del body los agregamos a la cancion
    song.title = params.title; 
    song.performer = params.performer;
    song.duration = params.duration;
    song.year = params.year; 
    song.style = params.style;
    song.rate = params.rate;

    try {
        // Insertamos en MongoDB y esperamos comprobando que ha habido respuesta
        const songStore = await song.save();

        // Cuando el servidor responda
        if (!songStore) {
            res.status(400).send({ msg: "Cancion no guardada correctamente" });
        } else {
            res.status(200).send({ song: songStore});
        }

    } catch(error) {
        res.status(500).send(error);
    }

}

/**
 * Lista todas las canciones
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function getSongs(req, res) {
    
    try {
        const songs = await Song.find();

        if (!songs) {
            res.status(400).send({ msg: "Error al obtener las canciones" });
        } else {
            res.status(200).send(songs);
        }

    } catch(error) {
        res.status(500).send(error);
    }

}

/**
 * Muestra una cancion por id
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function getSong(req, res) {
    // Sacamos el id de la url del endpoint
    const idSong = req.params.id;

    try {
        // Promesa
        const song = await Song.findById(idSong);

        if(!song) {
            res.status(400).send({ msg: "No se ha encontrado la cancion indicada" });
        } else {
            res.status(200).send(song);
        }
        
    } catch(error) {
        res.status(500).send(error);
    }

}

/**
 * Lista las 10 canciones con mejor puntuacion de manera descendente
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function getSongsTopRated(req, res) {
    
    try {
        const songs = await Song.find().sort({ rate: -1 }).limit(10);

        if (!songs) {
            res.status(400).send({ msg: "Error al obtener las canciones" });
        } else {
            res.status(200).send(songs);
        }

    } catch(error) {
        res.status(500).send(error);
    }

}

/**
 * Lista todas las canciones de un genero musical en formato JSON
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function getSongsGenre(req, res) {
    // Sacamos el genero de la url del endpoint
    const genreSong = req.params.genre;
    try {
        const songs = await Song.find({ genre : genreSong});

        if (!songs) {
            res.status(400).send({ msg: "Error al obtener las canciones" });
        } else {
            res.status(200).send(songs);
        }

    } catch(error) {
        res.status(500).send(error);
    }

}

/**
 * Actualiza la valoracion de una cancion, sumando la que se pasa en la request
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function updateSong(req, res) {
    // Sacamos el id de la url del endpoint
    const idSong = req.params.id;

    // Sacamos los cambios de la cancion en el body de la request
    const bodyJson = req.body;

    try {
        const song = await Song.findByIdAndUpdate(idSong, { $inc : { rate : bodyJson.rate } });

        if(!song) {
            res.status(400).send({ msg: "No se ha podido actualizar la cancion" });
        } else {
            res.status(200).send({ msg: "Cancion modificada" });
        }
        
    } catch(error) {
        res.status(500).send(error);
    }

}

/**
 * Elimina una tarea por id
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function deleteSong(req, res) {
    const idSong = req.params.id;

    try {
        
        const song = await Song.findByIdAndDelete(idSong);

        if(!song) {
            res.status(400).send({ msg: "No se ha encontrado la cancion indicada" });
        } else {
            res.status(200).send({ msg: "Cancion borrada" });
        }
        
    } catch(error) {
        res.status(500).send(error);
    }
   
}

module.exports = {
    createSong, 
    getSongs,
    getSong,
    getSongsTopRated,
    getSongsGenre,
    updateSong, 
    deleteSong
}