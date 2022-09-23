let authentication_code = '';
let auth_window = '';

function RequestAPI(method, url) {
    $.ajax({
        type: method,
        url: url,
        data: {
            query: $('textarea.form-control').val()
        },
        success: result => {
            console.log(result);
            const tweet = result.data[0];
            $('#hasil-search').append(`
                <p>@${$('textarea.form-control').val()}: ${tweet.text}</p>
            `);
        }
    });
}

$('#teken').on('click', function(){
    RequestAPI('get', 'api-fetch.php');
});

$('#log_in').on('click', function() {
    auth_window = window.open('https://twitter.com/i/oauth2/authorize?response_type=code&client_id=SjRLcTE4MDdhYzNXVzVibVhxQmk6MTpjaQ&redirect_uri=http://127.0.0.1:80/tes-rest-api/Mini-Project-Twitter-API/auth/&scope=tweet.read%20tweet.write%20users.read%20follows.read%20follows.write&state=state&code_challenge=challenge&code_challenge_method=plain', '_self', 'height=600,width=500');

});

$('#tweet_smth').on('click', function() {
    $.ajax({
        type: 'get',
        url: 'tweet_something.php',
        data: {
            query: $('textarea.form-control').val()
        },
        success: result => {
            console.log(result);
            if(result.data.text == $('textarea.form-control').val()){
                $('#contenthere').append(`<p>Success!</p>`);
            } else {
                $('#contenthere').append(`<p style="color: red;">Unauthorized!</p>`);
            }

        }
    });
});

$('#logout').on('click', function() {
    delete_cookie('access_token', '/');
    location.reload();
});

function delete_cookie( name, path ) {
    if( getCookie( name ) ) {
      document.cookie = name + "=" +
        ((path) ? ";path="+path:"")+
        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
    }
  }

function getCookie(user) {
    let cookieArr = document.cookie.split(";");
    for(let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if(user == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

function checkCookie() {
    const user = getCookie("access_token");
    if (user == null) {
      $('#logout').hide();  
      return;
    }
    $('#log_in').hide();
}

  checkCookie();

