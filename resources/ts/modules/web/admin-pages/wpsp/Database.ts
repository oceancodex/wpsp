class Database {

    public message: any = '#handle_database_message';
    public messageInner: any = '#handle_database_message_inner';

    constructor() {
        this.handleDatabase();
    }

    public handleDatabase() {
        jQuery(($) => {
            $('body').on('click', '.handle-database-button', (e) => {
                if (!$(this.message).hasClass('hidden')) {
                    this.addMessage('-----------------------------------------<br/>');
                }
                let type = $(e.currentTarget).attr('data-type');
                this.requestHandleDatabase(type);
            });
        });
    }

    public requestHandleDatabase(type: any, actions: any = null) {
        jQuery(($) => {
            $.ajax((<any>window).wpsp_localize.ajax_url, {
                method: 'POST',
                data: {
                    action: 'wpsp_handle_database',
                    type: type,
                    nonce: (<any>window).wpsp_localize.nonce
                },
                success: (response) => {
                    $(this.message).removeClass('hidden');
                    if (response.success) {
                        if (typeof response.data.actions !== 'undefined') actions = actions ?? response.data.actions;
                        if (actions[0]) {
                            this.addMessage(response.message);
                            this.requestHandleDatabase(actions[0], actions.slice(1));
                        } else {
                            this.addMessage(response.message, 'notice notice-success');
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                    else {
                        this.addMessage(response.message, 'notice notice-error');
                        setTimeout(() => {
                            $('.database-aditional-action-buttons').removeClass('hidden');
                            $('.database-aditional-action-message').removeClass('hidden');
                        }, 1000);
                    }
                }
            });
        });
    }

    public addMessage(text: string, classes: string = null) {
        jQuery(($) => {
            if (classes) {
                $(this.message).removeClass().addClass(classes);
            }
            $(this.message).find(this.messageInner).append(text).show();
            $(this.messageInner).scrollTop($(this.messageInner).prop('scrollHeight'));
        });
    }

}

new Database();