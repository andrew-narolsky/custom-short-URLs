import AppStorage from "./AppStorage";
import Token from "./Token";

class User {

    responseAfterLogin(response) {
        let access_token = response.data.access_token;
        let user_name = response.data.name;
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, user_name);
        }
    }

    hasToken() {
        let storeToken = AppStorage.getToken();
        if (storeToken) {
            return Token.isValid(storeToken) ? true : false;
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    name() {
        if (this.loggedIn()) {
            return AppStorage.getUser();
        }
    }

    id() {
        if (this.loggedIn()) {
            let payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
        return false;
    }
}

export default User = new User();
