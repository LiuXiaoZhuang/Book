import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../pages/Home.vue';
import Login from '../pages/Login.vue';
import LayoutsMenu from '../menus/LayoutsMenu.vue';
import Index from '../pages/Index.vue';
import User from '../pages/User.vue';

import PagesMenu from '../menus/PagesMenu.vue';


Vue.use(VueRouter);

export default new VueRouter({
    saveScrollPosition: true,
    routes: [
        {
            name: '首页',
            path: '/',
            redirect: '/layouts/index'
        },
        {
            name: 'UI 示例',
            path: '/layouts',
            component: Home,
            children:[
                {
                    name: '基本栅格',
                    path:"index",
                    components:{
                        default:Index,
                        menu:LayoutsMenu
                    }
                },
                {
                    name: '布局栅格',
                    path:"user",
                    components:{
                        default:User,
                        menu:LayoutsMenu
                    }
                }
            ]
        },
        {
            name: 'login',
            path: '/login',
            component: Login
        },
    ]
});
