const home = () => import('components/home-page');

export const routes = [
    { path: '/', name: 'default', component: home, display: 'Home' },
];

export default routes;