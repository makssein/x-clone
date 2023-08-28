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
