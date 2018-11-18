function signinError(errorMessage) {
    let errorDiv = "<div id='errorAlert' class='alert alert-danger' role='alert'>"+errorMessage+"</div>";
    if ($("#errorAlert")[0]) {
        $("#errorAlert").replaceWith( errorDiv );
    } else {
        $('#registrationText').after(errorDiv);
    }
}

$("#submit")[0].onclick = function() {
    $.ajax({
        type: 'POST',
        url: 'register.php',
        data: {
            'login': document.getElementById("login").value,
            'email': document.getElementById("email").value,
            'password': document.getElementById("password").value
        },
        success: function (response) {
            let responseJSON = JSON.parse(response);

            let errorText = '';
            if(!responseJSON.isSuccess) {
                switch (responseJSON.errorCode) {
                    case 1: errorText = 'Невозможно установить соединение с базой данных'; break;
                    case 2: errorText = 'Такой email или логин уже занят'; break;
                    default: errorText = 'Ошибка.'; break;
                }
                signinError(errorText)
            } else {
                window.location.href = '/';
            }
        }
    });
};

function validatePassword(){
    if(document.getElementById("password").value != document.getElementById("confirm").value) {
        document.getElementById("confirm").setCustomValidity("Пароли не совпадает");
    } else {
        document.getElementById("confirm").setCustomValidity('');
    }
}