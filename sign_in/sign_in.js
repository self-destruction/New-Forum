function signinError(errorMessage) {
    let errorDiv = "<div id='errorAlert' class='alert alert-danger' role='alert' style='margin-bottom: 0px'>"+errorMessage+"</div>";
    if ($("#errorAlert")[0]) {
        $("#errorAlert").replaceWith( errorDiv );
    } else {
        let error = $(errorDiv);
        error.prependTo("#signinAction");
    }
}

$("#submit")[0].onclick = function() {
    $.ajax({
        type: 'POST',
        url: 'sign_in.php',
        data: {
            'email': document.getElementById("email").value,
            'password': document.getElementById("password").value
        },
        success: function (response) {
            let responseJSON = JSON.parse(response);

            let errorText = '';
            if(!responseJSON.isSuccess) {
                switch (responseJSON.errorCode) {
                    case 1: errorText = 'Невозможно установить соединение с базой данных'; break;
                    case 2: errorText = 'Email или пароль введён неверно.'; break;
                    default: errorText = 'Ошибка.'; break;
                }
                signinError(errorText)
            } else {
                window.location.href = '/';
            }
        }
    });
};

document.getElementById("copyright_year").innerHTML =
    "&copy; " + new Date().getFullYear() + "-" + (new Date().getFullYear() + 1);