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
                    //$("#comments").html(data);
                    let d = JSON.parse(data); // JSON.parse - Преобразует json в объект
                    //console.log(d);


                    $("#comments").html(d.comments);
                    $("#cc").html(d.cc);
                    name.val(''); // очищаем поля формы
                    email.val('');
                    message.val('');
                    //let  cc = $("#cc").html(); //Получаем колличество комментариев из строки <span>
                    //let newCc = parseInt(cc) + 1; //Увеличиваем на 1
                    //$("#cc").html(newCc); // Перезаписываем <span>
                }
            });
        } else {
            $("#form_error").html('Заполните все поля');
        }
    });

    $("input, textarea").focus(function () { // Очищаем ошибки
        $("#form_error").html('');
    });

    $("#subscribe").click(function (){ // слушает, когда произойдет клик по кнопку "Подписаться" c id="subscribe"
         //console.log(222);
         let subscribeEmail = $("#subscribe_email");
         //console.log(email.val());

         if(subscribeEmail.val() != ''){
            console.log($("#subscribeForm").serialize());
            $.ajax({ // ajax-запрос - отравляет данные по пути '/ajax/subscribe_ajax.php' методом post
                type: 'post',
                url: '/ajax/subscribe_ajax.php',
                data: $("#subscribeForm").serialize(),
                success: function (data) { //data - что возвращает (в этой строке data - это данные, которые возвращаются с '/ajax/comments_ajax.php')
                    
                    console.log(data);
                }
             });
        }else{
            $("#subscribe_error").html('Введите ваш email');
         }
    });

    $("input").focus(function () { // Очищаем ошибки
        $("#subscribe_error").html('');
    });
});