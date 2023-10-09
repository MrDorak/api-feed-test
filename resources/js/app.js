import './bootstrap';

// check every minute if there is a new instagram post, in which case it'll refresh the page
window.setInterval(() => {
    axios.get('/raw/instagram-auth-refresh/' + document.getElementById('user_id').value)
        .then(res => {
            if (res.data.feed_length !== parseInt(document.getElementById('length').value)) {
                window.location.reload();
            }
        })
}, 60000)

