$(document).ready(function () { //скрипт выполнится, когда страница будет полностью загружена
    $("#send_comment").click(function () { // слушает, когда произойдет клик по кнопку "Отправить" c id="send_comment"
        //console.log(222);
        let name = $("#name"); // Создали переменные и получили в них объекты наших input
        let email = $("#email");
        let message = $("#message");


        if (name.val() != '' && email.val() != '' && message.val != '') { //Все поля должны быть заполнены
            $.ajax({ // ajax-запрос - отравляет данные по пути '/ajax/comments_ajax.php' методом post
                type: 'post',
                url: '/ajax/comments_ajax.php',
                data: $("#form").serialize(), //собирает в кучу (в этой строке data - это один из параметров ajax-запроса)
                success: function (data) { //data - что возвращает (в этой строке data - это данные, которые возвращаются с '/ajax/comments_ajax.php')
                    console.log(data);
                }
            });
        } else {
            $("#form_error").html('Заполните все поля');
        }
    });

    $("input, textarea").focus(function () { // Очищаем ошибки
        $("#form_error").html('');
    });
});