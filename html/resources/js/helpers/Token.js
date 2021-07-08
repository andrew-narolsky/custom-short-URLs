class Token {

    isValid(token) {
        let payload = this.payload(token);
        if (payload) {
            return payload.iss = 'http://localhost/api/auth/login' || 'http://localhost/api/auth/register' ? true : false;
        }
        return false;
    }

    payload(token) {
        let payload = token.split('.')[1];
        return this.decode(payload);
    }

    decode(payload) {
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token();
