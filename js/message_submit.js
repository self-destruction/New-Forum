function creatingMessage(messageText, person, message_date) {
    document.getElementById("messageArea").value = "";

    let messageTextHTML =
        "<tr class=\"d-flex\">\n" +
        "  <td class=\"col-3 text-center\">\n" +
        "    <a href=\"/person?login=" + person.login + "\">" + person.login + "</a><br>\n" +
        "      <small>" + message_date + "</small>\n" +
        "  </td>\n" +
        "  <td class=\"col\">\n" +
        "    <div class=\"align-top text-left\">\n" +
        messageText +
        "    </div>\n" +
        "  </td>\n" +
        "</tr>";

    $('tbody').append(messageTextHTML);
}

$("#submit")[0].onclick = function() {
    // document.getElementById("messageArea").value = "";

    let message = document.getElementById("messageArea").value,
        theme_id = window.location.search.slice(4);

    console.log({'message': message, 'theme_id': theme_id});

    if (!isValidData(1, 1000, message)) {
        document.getElementById("submit").setCustomValidity("Некорректное сообщение");
    } else {
        $.ajax({
            type: 'POST',
            url: 'message_post',
            data: {
                'message': message,
                'theme_id': theme_id
            },
            success: function (response) {
                let responseJSON = JSON.parse(response);
                console.log(responseJSON);

                let errorText = '';
                if (!responseJSON.isSuccess) {
                    switch (responseJSON.errorCode) {
                        case 1:
                            errorText = 'Невозможно установить соединение с базой данных';
                            break;
                        case 2:
                            errorText = 'По какой-то причине не удалось добавить запись';
                            break;
                        default:
                            errorText = 'Ошибка.';
                            break;
                    }
                    alert(errorText);
                } else {
                    creatingMessage(message, responseJSON.person, responseJSON.message_date);
                }
            }
        });
    }
};