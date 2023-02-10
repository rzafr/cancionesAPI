const jwt = require("jsonwebtoken");

const SECRET_KEY = "23441jhsfdj23flflsefFDSHJFDS12";

/**
 * Crea el token de acceso del usuario
 * 
 * @param {*} user 
 * @param {*} expiresIn 
 * @returns 
 */
function createToken(user, expiresIn) {
    const { id, email } = user;
    const payload = { id, email };

    return jwt.sign(payload, SECRET_KEY, { expiresIn: expiresIn });
}

/**
 * Decodifica el token del usuario
 * 
 * @param {*} token 
 * @returns 
 */
function decodeToken(token) {
    return jwt.decode(token, SECRET_KEY);
}

module.exports = {
    createToken, 
    decodeToken
}
