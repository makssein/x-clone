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
        defaultTabId: 'follows',
        activeClasses: 'border-b-4 dark:border-cyan-300',
        inactiveClasses: '_',
    }
);

