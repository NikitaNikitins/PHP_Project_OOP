import home from 'components/home-page';
import login from 'components/auth/login';
import register from 'components/auth/register';
import services from 'components/services/services-list';
import completedProjects from 'components/completed-projects/completed-projects-list';
import userList from 'components/users/users-list';

//garbage
import createDB from 'components/for-presentation/create-database';
import erDiagram from 'components/for-presentation/er-diagram';
import funct from 'components/for-presentation/functions';
import storedPr from 'components/for-presentation/stored-procedures';
import triggs from 'components/for-presentation/triggers';

export const routes = [
    { path: '/', name: 'default', component: home, display: 'Home' },
    { path: '/login', name: 'login', component: login, display: 'Login' },
    { path: '/register', name: 'register', component: register, display: 'Register' },
    { path: '/services', name: 'services', component: services, display: 'Services' },
    { path: '/completedProjects', name: 'projects', component: completedProjects, display: 'Projects' },
    { path: '/userList', name:'users', component: userList},

    { path: '/create-database-sql',  component: createDB},
    { path: '/er-diagram',  component: erDiagram},
    { path: '/stored-functions', component: funct},
    { path: '/stored-procedures',component: storedPr},
    { path: '/created-triggers',  component: triggs},
];

export default routes;
