// Configuramos express y cargamos las rutas en la aplicacion fusionando todos los datos
const express = require('express')

// Incializamos express y lo guardamos en la variable app
const app = express()

// Configuramos el body, todas las respuestas seran con JSON
app.use(express.json());
app.use(express.urlencoded({ extended: true}));

// Soluciona el problea de CORS
// Permite peticiones a la API desde ese dominio. Poner *, para atender peticiones desde cualquier punto.
app.use((req, res, next) => {
    res.setHeader("Access-Control-Allow-Origin", "*");
    res.setHeader("Access-Control-Allow-Methods", "GET, POST, DELETE, PUT");
    res.header(
      "Content-Type","Content-Length","Server","Date","Access-Control-Allow-Methods","Access-Control-Allow-Origin"
    );
    next();
  });

// Cargamos las rutas
const song_routes = require("./routes/song");
const user_routes = require("./routes/user");

// Rutas base
app.use("/api", song_routes);
app.use("/api", user_routes);

// Exportamos para usarlo en otro archivo
module.exports = app;