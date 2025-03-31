import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

const options = {
    broadcaster: 'pusher',
    key: '2696d3838d296fdd359e',
    cluster: 'sa1'
}

window.Echo = new Echo({
    ...options,
    client: new Pusher(options.key, options)
});