// Importamos libreria para realizar la conexion a base de datos
const mongoose = require('mongoose');
const app = require("./app");

// Agregamos el puerto donde va a correr el servidor nodejs
const port = 3000;

// Constante con la url de conexion a base de datos
const urlMongoDB = "mongodb+srv://admin:GMqeq91lquHBgB91@cluster0.riicpti.mongodb.net/songs";
//const urlMongoDBL = "mongodb://root:toor@mongoapi:27017/";

mongoose.set('strictQuery', false);

// Conectamos con la base de datos
mongoose.connect(urlMongoDB, {
  useNewUrlParser: true, 
  useUnifiedTopology: true
}, (err, res) => {

  try {
    if(err) {
      throw err
    } else {
      // Mensaje de que todo ha ido bien
      console.log("Conexion correcta a la base de datos");

      // Levantamos el servidor
      app.listen(port, () => {
        console.log(`Example app listening on port ${port}`)
      })
    }
  } catch(err) {
    console.error(err);
  }
});



