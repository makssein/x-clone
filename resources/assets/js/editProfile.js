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
