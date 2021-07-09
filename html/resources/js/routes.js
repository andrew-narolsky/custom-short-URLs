export const routes = [
    // Application
    {
        path: '/',
        component: () => import('./components/application'),
        name: 'application'
    },
    // Auth
    {
        path: '/login',
        component: () => import('./components/auth/login'),
        name: 'login'
    },
    {
        path: '/logout',
        component: () => import('./components/auth/logout'),
        name: 'logout'
    }
];
