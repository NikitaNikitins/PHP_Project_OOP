const home = () => import('components/home-page');
const login = () => import( 'components/auth/login');

export const routes = [
    { path: '/', name: 'default', component: home, display: 'Home' },
    { path: '/login', name: 'login', component: login, display: 'Login' },
];

export default routes;