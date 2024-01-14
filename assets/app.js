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
 * SCRIPTS
 */
/*
 * Can't use dynamic require on js files, they went to "unused" 
 */
import './scripts/global.js'

/**
 * STYLES
 */
// Any CSS you import will output into a single css file (app.css in this case)

/* Dynamic imports
 * @see https://github.com/webpack/webpack/issues/118
*/
//require.context("./styles/app", true, /* (sub) */ /.*/)
import './styles/global.scss'
