/**
 * Symfony UX
 * @see https://symfony.com/doc/current/frontend/ux.html
 * 
 * @see https://stimulus.hotwired.dev
 * @see https://turbo.hotwired.dev
 */

import { startStimulusApp } from '@symfony/stimulus-bridge';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);
