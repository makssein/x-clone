$('#signin_form').submit(function (e) {
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
                window.location.replace("/profile");
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


$('#signup_form').submit(function (e) {
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
                this.reset();
                _self.closest('#signup-modal').find('button[data-modal-hide]').trigger('click');
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

function createToast(data) {
    let toasts_block = $("#toasts");
    if(!toasts_block) {
        $('body').append('<div id="toasts" class="fixed right-5 pt-5"></div>');
        toasts_block =  $("#toasts");
    }

    let icon_svg, icon_color;
    switch (data.type) {
        case 'success':
            icon_svg = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">\n' +
                ' <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>\n' +
                '</svg>';
            icon_color = 'dark:bg-green-800 dark:text-green-200';
            break;
        case 'error':
            icon_svg = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">\n' +
                ' <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>\n' +
                '</svg>';
            icon_color = 'dark:bg-red-800 dark:text-red-200';
            break;
        case 'warn':
            icon_svg = '<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">\n' +
                ' <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>\n' +
                '</svg>';
            icon_color = 'dark:bg-orange-700 dark:text-orange-200';
            break;
    }

    const toast = $( '<div data-toast-success class="flex w-screen items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 right-5" role="alert">\n' +
        ' <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg '+ icon_color +'">\n' +
           icon_svg +
        '  <span class="sr-only">Иконка</span>\n' +
        ' </div>\n' +
        ' <div class="ml-3 text-sm font-normal">'+ data.message +'</div>\n' +
        ' <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">\n' +
        '  <span class="sr-only">Закрыть</span>\n' +
        '  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">\n' +
        '   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>\n' +
        '  </svg>\n' +
        ' </button>\n' +
        '</div>\n').hide();

    toasts_block.append(toast);

    toast.slideDown(100);

    setTimeout(() => toast.remove(), 5000);
}

