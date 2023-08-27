$("#follow_user_form, [data-follow-form]").submit(function (e) {
    e.preventDefault();

    const _self = $(this);
    const submit_button = _self.find(':submit');
    submit_button.addClass('disabled');
    submit_button.prop('disabled', true);

    const url = _self.attr('action');
    const data = new FormData(this);

    axios.post(url, data)
        .then(data => {
            if (data.data.status) {
                if(submit_button.text().includes('Подписаться')) {
                    submit_button.text('Отписаться')
                        .removeClass('bg-cyan-600 hover:bg-cyan-700')
                        .addClass('bg-transparent border border-slate-500  hover:bg-slate-800');
                } else {
                    submit_button.text('Подписаться')
                        .removeClass('bg-transparent border border-slate-500  hover:bg-slate-800')
                        .addClass('bg-cyan-600 hover:bg-cyan-700');
                }
            }
        })
        .catch(() => {
            createToast({message: "Произошла ошибка. Попробуйте еще раз.", type: "error"});
        })
        .finally(() => {
            submit_button.removeClass('disabled');
            submit_button.prop('disabled', false);
        });
});
