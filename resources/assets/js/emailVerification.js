$('#send_email_verification_form').submit(function (e) {
    e.preventDefault();

    const _self = $(this);
    const submit_button = _self.find(':submit');
    submit_button.addClass('disabled');
    submit_button.prop('disabled', true);

    const url = _self.attr('action');
    const data = new FormData(this);

    axios.post(url, data)
        .then(data => {
            if(data.data.status) {
                createToast({...data.data});
            } else {
                createToast({...data.data});
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
