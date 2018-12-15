function signinError(errorMessage) {
    let errorDiv = "<div id='errorAlert' class='alert alert-danger' role='alert'>"+errorMessage+"</div>";
    if ($("#errorAlert")[0]) {
        $("#errorAlert").replaceWith( errorDiv );
    } else {
        $('#registrationText').after(errorDiv);
    }
}

$("#submit")[0].onclick = function() {
    let login = document.getElementById("login").value,
        email = document.getElementById("email").value,
        password = document.getElementById("password").value,
        confirm = document.getElementById("confirm").value;

    console.log({'login': login, 'email': email, 'password': password, 'confirm' : confirm});

    let isEmailValid = ($('#email').val().match(/.+?\@.+/g) || []).length === 1,
        isPasswordValid = password === confirm;

    if (!isEmailValid) {
        signinError('Некорректный email');
    } else {
        if (!isPasswordValid) {
            signinError('Пароли не совпадают');
        } else {
            $.ajax({
                type: 'POST',
                url: 'register_post',
                data: {
                    'login': login,
                    'email': email,
                    'password': password
                },
                success: function (response) {
                    console.log(response);
                    let responseJSON = JSON.parse(response);

                    let errorText = '';
                    if (!responseJSON.isSuccess) {
                        switch (responseJSON.errorCode) {
                            case 1:
                                errorText = 'Невозможно установить соединение с базой данных';
                                break;
                            case 2:
                                errorText = 'Такой email или логин уже занят';
                                break;
                            default:
                                errorText = 'Ошибка';
                                break;
                        }
                        signinError(errorText)
                    } else {
                        window.location.href = '/';
                    }
                }
            });
        }
    }
};

function validatePassword(){
    if(document.getElementById("password").value != document.getElementById("confirm").value) {
        document.getElementById("confirm").setCustomValidity("Пароли не совпадает");
    } else {
        document.getElementById("confirm").setCustomValidity('');
    }
}

$("#login").change(function() {
    let login = document.getElementById("login").value;

    console.log({'login': login});
});

$("#email").change(function() {
    let email = document.getElementById("email").value;

    console.log({'email': email});
});

$("#password").change(function() {
    let password = document.getElementById("password").value;

    console.log({'password': password});
});