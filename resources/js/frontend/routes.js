let layout = require('./components/layouts/layout.vue').default;
let blanklayout = require('./components/layouts/blanklayout.vue').default;


let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;


let home = require('./components/recharge/RechargePage.vue').default;
let rechargecheckout = require('./components/recharge/rechargecheckout.vue').default;
let rechargesuccess = require('./components/recharge/rechargesuccess.vue').default;
let rechargeFailed = require('./components/recharge/rechargeFailed.vue').default;


let PageNotFound = require('./components/404.vue').default;


let prefix = '/'
export const routes = [

    { path:  `${prefix}payment/:Stoken`, component: home, name:'home',meta: { layout: layout } },
    { path:  `${prefix}checkout/:Stoken`, component: rechargecheckout, name:'rechargecheckout',meta: { layout: layout } },
    { path:  `${prefix}success/:Stoken`, component: rechargesuccess, name:'rechargesuccess',meta: { layout: layout } },
    { path:  `${prefix}failed/:Stoken`, component: rechargeFailed, name:'rechargeFailed',meta: { layout: layout } },


    { path: `${prefix}login`, component: login, name:'/login',meta: { layout: blanklayout } },
    { path:  `${prefix}register`, component: register, name:'register',meta: { layout: blanklayout } },
    { path:  `${prefix}forget`, component: forget, name:'forget',meta: { layout: blanklayout } },

  { path: "*", component: PageNotFound }

]

