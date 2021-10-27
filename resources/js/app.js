/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */


import React from 'react'
import { render } from 'react-dom'
import { createInertiaApp } from '@inertiajs/inertia-react'

//Vidi ova zasto go importirame kako cekor e posleden za frontend za inertia
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init();

createInertiaApp({
   resolve: name => require(`./Pages/${name}`),
   setup({ el, App, props }) {
      render(<App {...props} />, el)
   },
});


require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');
require('./components/ShowWithReact');
require('./components/ClassComponent');
require('./components/ModalReact');
require('./components/ReactSearch');
require('./components/Calendar');
