const moment = require("moment");
const jwt = require("../services/jwt");

const SECRET_KEY = "23441jhsfdj23flflsefFDSHJFDS12";

/**
 * Comprueba que el usuario esta registrado y su token es valido
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 * @returns 
 */
function ensureAuth(req, res, next) {
    // Obtenemos la cabecera de la peticion, donde mandar el token
    if (!req.headers.authorization) {
        return res.status(403).send({ msg: "Token no enviado en la cabecera" });
    } else {
        const token = req.headers.authorization.replace(/['"]+/g, "");
        try {
            // Comprobamos que el token es valido
            const payload = jwt.decodeToken(token, SECRET_KEY);
            // Comprobamos la fecha de expiracion del token
            if (payload.exp <= moment().unix()) {
                return res.status(400).send({ msg: "El token ha expirado" });
            }
            // Si el token es valido
            req.user = payload;
            next();
        } catch (error) {
            return res.status(400).send({ msg: "Token no valido" });
        }
    }
}

module.exports = {
    ensureAuth
}