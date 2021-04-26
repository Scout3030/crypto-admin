require('./bootstrap');

Echo.private(`notifications-${window.Laravel.userId}`).listen('NewNotification', (e) => {
    document.getElementById('notification-counter').classList.remove('d-none');

    document.getElementById('notification-counter').innerHTML = e.data.count;
    document.getElementById('notification-list').innerHTML = e.data.html;
});
