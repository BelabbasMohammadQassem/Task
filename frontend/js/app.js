import { tasks } from "./tasks.js";

const app = {
    init: function() {
        console.log('app.init');
        tasks.init();
    }
}

document.addEventListener('DOMContentLoaded', app.init);