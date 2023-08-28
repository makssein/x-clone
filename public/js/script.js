$('#edit_profile_form').submit(function (e) {
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
                _self.closest('#edit_profile-modal').find('button[data-modal-hide]').trigger('click'); //закрытие модального окна
                createToast({...data.data});
                updateProfile(data.data.object)
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

$("#banner_input, #avatar_input").change(function (e) {
    e.preventDefault();

    const _self = $(this);
    const image = _self.prop('files')[0];

    const id = _self.attr('id');
    const preview_id = id.split('_')[0];

    if(id === 'banner_input') {
        const label = $("label[for='delete_banner']");

        label.removeClass('hidden');
    }

    if(!image) return;

    if((image.size / 10**6) > 5) {
        return createToast({message: "Файл слишком большой. Максимальный размер - 5 мб.", type: "error"});
    }

    const reader = new FileReader();

    reader.onload = function (event) {
        $("#"+ preview_id +"_preview").attr('src', reader.result);
    };

    reader.readAsDataURL(image);
});

$("body").on('change', '#delete_banner', function () {
    const _self = $(this);
    const checked = _self.is(":checked");

    if(checked) {
        const avatar_preview = $("#banner_preview");
        const src = avatar_preview.attr('src');
        const data_src = avatar_preview.attr('data-user-banner-link');

        if(data_src && src !== data_src) { //уже был установлен какой-то баннер: превью поверх основного баннера или просто основной баннер
            avatar_preview.attr('src', data_src);
            _self.prop('checked', false);
            $("#banner_input").val(''); //очищаем инпут с картинкой
        } else { //удаляется либо превью, если баннера не было, либо сам баннер
            avatar_preview.attr('src', '/img/default/default-banner.svg');
            avatar_preview.removeAttr('data-user-avatar-link');
            _self.closest('label').addClass("hidden");
            _self.addClass("hidden");
        }
    }
});

function updateProfile(data) {
   if(!data) return;

   const profile_banner = $("#profile_banner");
   const profile_avatar = $("#profile_avatar");
   const profile_name = $("#profile_name");
   const profile_username = $("#profile_username");
   const profile_bio = $("#profile_bio");


   profile_banner.attr('src', data.banner ? '/storage/' + data.banner : '/img/default/default-banner.svg');
   profile_avatar.attr('src', data.avatar ? '/storage/' + data.avatar : '/img/default/default-avatar.svg');
   profile_name.text(data.name);
   profile_username.text('@' + data.username);
   profile_bio.text(data.bio);
}

$("#update_info_form").submit(function(e) {
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
                window.location.href = data.data.redirect;
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


$("#new_password_form").submit(function(e) {
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
                this.reset()
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
                window.location.replace("/");
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
                _self.closest('#signup-modal').find('button[data-modal-hide]').trigger('click'); //закрытие модального окна
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

$('#create_post_form').submit(function (e) {
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
                displayPost("#feed", data.data.object);
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

function displayPost(selector, data) {
    const posts_block = $(selector);

    const post_date = parsePostDate(data.created_at);

    const avatar_src = data.user.avatar ? '/storage/' + data.user.avatar : '/img/default/default-avatar.svg';

    data.text = data.text.replaceAll("\r\n", "<br>");
    data.text = data.text.replaceAll("\r", "<br>");
    data.text = data.text.replaceAll("\n", "<br>");

    posts_block.prepend(
        '<div class="flex p-4 border-b border-gray-700 w-full">\n' +
        '   <div class="mr-2 flex-shrink-0">\n' +
        '       <img class="w-10 h-10 rounded-full mr-4 object-cover" src="'+ avatar_src +'" alt="avatar">\n' +
        '   </div>\n' +
        '   <div class="w-full">\n' +
    '           <div class="flex items-center justify-between w-full">' +
    '               <div class="flex items-center">' +
    '                   <a href="/profile/'+ data.user.username +'">' +
    '                       <h5 class="font-bold">\n' +
                                data.user.name +
    '                           <span class="text-sm ml-1 font-normal text-gray-500">@'+ data.user.username +'</span>\n' +
    '                       </h5>\n' +
    '                   </a>' +
    '                   <span class="text-sm mt-0.5 ml-1 font-medium text-gray-500">&#183;</span>\n' +
    '                   <span class="text-sm mt-0.5 ml-1 font-normal text-gray-500">'+ post_date +'</span>\n' +
    '               </div>' +
    '           </div>' +
    '           <p class="text-sm whitespace-normal">\n' +
                    data.text +
    '           </p>\n' +
    '       </div>\n' +
        '</div>'
    );
}

function getFeed(url) {
    axios.get(url)
        .then(data => {
            data.data.reverse();
            data.data.forEach(post => {
                displayPost('#feed', post);
            });
        })
        .catch(() => createToast({message: "Произошла ошибка. Попробуйте еще раз.", type: "error"}))
}

function parsePostDate(date) {
    const today = new Date();
    date = new Date(date);

    const options = {
        hour: "numeric",
        minute: "2-digit",
        hour12: false,
    }
    if(today.toDateString() !== date.toDateString()) {
        Object.assign(options, {
                month: "short",
                day: "numeric"
            });
    }
    if(today.getFullYear() !== date.getFullYear()) {
        Object.assign(options, {
            year: "numeric",
        });
    }

    const formatter = Intl.DateTimeFormat('ru-RU', options);

    return formatter.format(date);
}

if(window.location.pathname === '/profile') {
    new Tabs(
        [
            {
                id: 'main',
                triggerEl: document.querySelector('#main_tab-tab'),
                targetEl: document.querySelector('#main_tab')
            },
            {
                id: 'follows',
                triggerEl: document.querySelector('#follows_tab-tab'),
                targetEl: document.querySelector('#follows_tab')
            },
            {
                id: 'followers',
                triggerEl: document.querySelector('#followers_tab-tab'),
                targetEl: document.querySelector('#followers_tab')
            },
        ],
        {
            defaultTabId: 'main',
            activeClasses: 'border-b-4 dark:border-cyan-300',
            inactiveClasses: '_',
        }
    );
}

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

