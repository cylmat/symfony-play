const $ = require('jquery');
//require('bootstrap'); // e.g. require('bootstrap/js/dist/popover');
//import sample from './sample.js';

import * as bootstrap from 'bootstrap';

$(document).ready(function() {
    // $('[data-toggle="popover"]').popover();
});

const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', () => {
    const toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}
