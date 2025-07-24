if (navigator.webdriver) {
    fetch('/bot-detected.php');
    alert("I smell a bot");
    window.location.href = "https://www.google.com/search?q=bot+detected";
}

var Emilio = {

    show_notification: function (title, message) {

        $('#notif_bubble_title').html(title);
        $('#notif_bubble_text').html(message);
        $('#notif_bubble').stop().fadeIn();//.removeClass("hidden");
        $('#notif_bubble').fadeOut(3600, function () {
            //     $(this).addClass("hidden");

        });

    },
    prevent_losses_of_data: function ($form) {
        // Marcar el formulario como modificado si cambia algo relevante
        let formChanged = false;
        $form.on('change input', 'input, textarea, select', function () {
            formChanged = true;
        });

        // Interceptar clics en enlaces
        $('a').on('click', function (e) {
            const isSubmitButton = $(this).attr('type') === 'submit' || $(this).hasClass('submit');
            const isExternal = this.hostname !== window.location.hostname;

            if (!isSubmitButton && !$(this).is('[type="submit"]') && formChanged) {
                const confirmed = confirm('Se perderán los cambios si no se guarda. ¿Deseas salir de todas formas?');
                if (!confirmed) {
                    e.preventDefault();
                }
            }
        });
    },
    update_service: function (param, value) {
        if (!value) {
            value = 0; //parseInt(value);
        }

        $.post(base_url + 'app_service', {
            "param": param,
            "value": value
        }, function (response) {
            console.log(response);
        });
    },
    DeleteRegistro: function (div_id, id_registro, cat, tabla) {

        if (confirm("¿Seguro que quieres eliminarlo?") != false) {
            $('#' + div_id).remove();
            //	document.getElementById(div_id).style.display = 'none';	
            $.ajax({
                type: 'POST',
                url: base_url + 'app_delete_row/',
                data: {
                    rid: id_registro,
                    table: tabla,
                    f: div_id
                },
                success: function (response) {
                    let aux = response;
                    // if (aux == 1) $('#' + div_id).html('ninguno');
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                }
            });

        }
    }

}


$(document).ready(function () {

    // Load defaults homepage:

    console.log("Emilio! Loaded...");
    var active_link_class = 'font-bold';
    // Add style to the link hrefing the current page

    // NOT WORKING BECAUSE THERE IS ALREADY TEXT_BLUE
    var uri = document.location.href.substr(document.location.href.indexOf(base_url) + base_url.length);
    console.log(base_url, uri);
    $("nav#sidebar ul li a[href='" + base_url + '/' + uri + "']").each(function () {
        $(this).addClass(active_link_class);
    });

    // End defaults homepage



    $('#button_open_mobile_menu').click(function () {
        $('#mobile_menu').removeClass("hidden");
    })

    $('#button_close_mobile_menu').click(function () {
        $('#mobile_menu').addClass("hidden");
    })

    const $form = $('#orm_form');
    if ($form.length) {
        Emilio.prevent_losses_of_data($form);
    }

});
