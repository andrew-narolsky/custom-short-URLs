class AppStorage {

    store(token, user) {
        localStorage.setItem('token', token);
        localStorage.setItem('user', user);
    }

    clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    }

    getToken() {
        return localStorage.getItem('token');
    }

    getUser() {
        return localStorage.getItem('user');
    }
}

export default AppStorage = new AppStorage();
