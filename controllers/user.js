const User = require("../models/user");
const bcryptjs = require("bcryptjs");
const jwt = require("../services/jwt");

/**
 * Inserta un usuario en la base de datos
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function register(req, res) {

    const user = new User();
    const { name, lastname, email, password } = req.body;

    try {

        if (!email) throw { msg: "Debes introducir un email" };
        if (!password) throw { msg: "Debes introducir una password" };

        // Comprobamos que el email esta ya registrado en la BBDD
        const foundEmail = await User.findOne({ email: email });
        if (foundEmail) throw { msg: "Email ya registrado" };
        
        const salt = await bcryptjs.genSalt(10);

        // Los datos del body los agregamos al usuario
        user.name = name; 
        user.lastname = lastname;
        user.email = email;
        user.password = await bcryptjs.hashSync(password, salt);

        // Insertamos en MongoDB
        const userStore = await user.save();        

        if (!userStore) {
            res.status(400).send({ msg: "Usuario no guardado correctamente" });
        } else {
            res.status(200).send({ user: userStore});
        }

    } catch(error) {
        res.status(500).send(error);
    }
    
}

/**
 * Controla el login del usuario
 * 
 * @param {*} req 
 * @param {*} res 
 */
async function login(req, res) {
    const { email, password } = req.body;

    try {
        const user = await User.findOne({ email: email});
        if (!user) throw { msg: "Email o password incorrectos" };

        // Generar el hash con el password recibido en el request 
        // Comprueba que coincide con el que ya hay en BBDD (user.password)
        const passwordSuccess = await bcryptjs.compare(password, user.password);
        if (!passwordSuccess) throw { msg: "Email o password incorrectos" };

        // Generamos token de login correcto y lo enviamos al usuario
        res.status(200).send({ token: jwt.createToken(user, "12h") });
        
    } catch(error) {
        res.status(500).send(error);
    }

}

module.exports = {
    register,
    login,
}
