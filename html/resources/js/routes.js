export const routes = [
    // Application
    {
        path: '/application',
        component: () => import('./components/application'),
        name: 'application'
    },
    // Auth
    {
        path: '/',
        component: () => import('./components/auth/login'),
        name: 'login'
    },
    {
        path: '/logout',
        component: () => import('./components/auth/logout'),
        name: 'logout'
    }
];
