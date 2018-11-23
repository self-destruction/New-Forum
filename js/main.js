$("#personPage")[0].onclick =
    function() {
    $.ajax({
        type: 'POST',
        url: '../person/person_.php',
        data: { },
        success: function (response) {
            let responseJSON = JSON.parse(response);

            if(responseJSON.isSuccess) {
                (function () {
                    console.log(responseJSON.data.login);
                    // $.ajax({
                    //     type: 'POST',
                    //     url: ''
                    // });
                }());
                // window.location.href = '/';
            } else {
                window.location.href = '/';
            }
        }
    });
};