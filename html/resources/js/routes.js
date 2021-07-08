// Admin
let application = require('./components/application').default;
// Auth
let login = require('./components/auth/login').default;
let logout = require('./components/auth/logout').default;

export const routes = [
    // Admin
    {
        path: '/',
        component: application,
        name: 'application'
    },
    // Auth
    {
        path: '/login',
        component: login
    },
    {
        path: '/logout',
        component: logout
    }
];
