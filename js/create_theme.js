function creatingThemeMessage(isSuccess, messageText) {
    let messageTextDiv;
    if (isSuccess) {
        messageTextDiv = "<div id='messageText' class='alert alert-success' role='alert'>"+messageText+"</div>";
    } else {
        messageTextDiv = "<div id='messageText' class='alert alert-danger' role='alert'>"+messageText+"</div>";
    }
    if ($("#messageText")[0]) {
        $("#messageText").replaceWith( messageTextDiv );
    } else {
        $('#createThemeText').after(messageTextDiv);
    }
}

$("#submit")[0].onclick = function() {
    let theme_title = document.getElementById("theme_title").value,
        theme_description = document.getElementById("theme_description").value;

    $.ajax({
        type: 'POST',
        url: 'create_theme_post',
        data: {
            'theme_title': theme_title,
            'theme_description': theme_description
        },
        success: function (response) {
            let responseJSON = JSON.parse(response),
                isSuccess = responseJSON.isSuccess;

            let messageText = '';
            if(!isSuccess) {
                switch (responseJSON.errorCode) {
                    case 1: messageText = 'Невозможно установить соединение с базой данных.'; break;
                    case 2: messageText = 'Тема с таким названием уже существует.'; break;
                    default: messageText = 'Ошибка.'; break;
                }
            } else {
                messageText = 'Тема успешно создана';
            }
            creatingThemeMessage(isSuccess, messageText)
        }
    });
};

$("#theme_title").change(function() {
    let theme_title = document.getElementById("theme_title").value;

    console.log({'theme_title': theme_title});
});

$("#theme_description").change(function() {
    let theme_description = document.getElementById("theme_description").value;

    console.log({'theme_description': theme_description});
});