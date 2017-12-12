;(function ($) {
    $(document).ready(function () {

        function getUsers() {
            $.ajax({
                url: url_get_users,
                type: 'POST',
                success: function (result) {
                    if (result.status === 'done') {
                        $('#users_list_data').html(result.html);
                    } else {
                        alert('Ошибка!');
                    }
                },
                error: function () {
                    alert('Ошибка!');
                }
            });
        }

        $('form[name=ttb_user_edit]').submit(function (event) {
            event.preventDefault();
            var formSerialize = $(this).serialize();
            $.ajax({
                url: url_add_user,
                type: 'POST',
                data: formSerialize,
                success: function (result) {
                    if (result.status === 'done') {
                        getUsers();
                        alert('Пользователь добавлен.');
                    } else {
                        alert('Ошибка!');
                    }
                },
                error: function () {
                    alert('Ошибка!');
                }
            });
            $(this).trigger('reset');
        });

        $('body').on('click', '.del_user', function (event) {
            event.preventDefault();
            if (confirm('Удалить?')) {
                $.ajax({
                    url: $(this).data('href'),
                    type: 'GET',
                    success: function (result) {
                        if (result.status === 'done') {
                            getUsers();
                            alert('Пользователь удален.');
                        } else {
                            alert('Ошибка!');
                        }
                    },
                    error: function () {
                        alert('Ошибка!');
                    }
                });
            }
        });

        getUsers();
    });
})(jQuery);