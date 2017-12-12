;(function ($) {
    $(document).ready(function () {

        function getAccounts() {
            $.ajax({
                url: url_get_accounts,
                type: 'POST',
                success: function (result) {
                    if (result.status === 'done') {
                        $('#accounts_list_data').html(result.html);
                    } else {
                        alert('Ошибка!');
                    }
                },
                error: function () {
                    alert('Ошибка!');
                }
            });
        }

        $('form[name=ttb_account_edit]').submit(function (event) {
            event.preventDefault();
            var formSerialize = $(this).serialize();
            $.ajax({
                url: url_add_account,
                type: 'POST',
                data: formSerialize,
                success: function (result) {
                    if (result.status === 'done') {
                        getAccounts();
                        alert('Счет добавлен.');
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

        $('body').on('click', '.del_account', function (event) {
            event.preventDefault();
            if (confirm('Удалить?')) {
                $.ajax({
                    url: $(this).data('href'),
                    type: 'GET',
                    success: function (result) {
                        if (result.status === 'done') {
                            getAccounts();
                            alert('Счет удален.');
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

        getAccounts();
    });
})(jQuery);