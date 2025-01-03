/**
 * FRONT END 
 * 
 * @see https://symfony.com/doc/current/frontend.html
 */

/*
 * ! Can't use internal Node modules with Webpack ! Browser doesn't like it !
 * const fs = eval('require("fs")') || __non_webpack_require__("fs")
 *
 * @see https://stackoverflow.com/questions/39249237/node-cannot-find-module-fs-when-using-webpack
 */

/**
 * STIMULUS
 */
//import './stimulus/stimulus.js'

/**
 * START THEME
 */
//import './theme/startbootstrap.js'

/**
 * SCRIPTS
 * Can't use dynamic require on js files, they went to "unused" 
 *
 * SAMPLE 
 * @see https://symfonycasts.com/screencast/webpack-encore/require-import
 * @see https://codesweetly.com/javascript-module-bundler
 * 
 * //const runapi = require('./scripts/runapi.js'); # without Webpack
 */
import './scripts/global.js'
import sample from './scripts/sample.js'
import runapi from './scripts/runapi';


/**
 * STYLES
// Any CSS you import will output into a single css file (app.css in this case)
 */

/*
 * Dynamic imports
 * @see https://github.com/webpack/webpack/issues/118
 */
import './styles/global.scss'

//require.context("./styles/app", true, /* (sub) */ /.*/)