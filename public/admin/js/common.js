const _auth = {
    login: function () {
        const _this = this;
        $('body').on('click', '.js-submit-button', function () {
            const form = $(this).closest('form');
            const request = new _glob.request(form);
            request.send();
        })
    },
    run: function () {
        $('form').submit(function (evt) {
            evt.preventDefault();
        });
        this.login();
    }
};

$(document).ready(function () {
    _glob.run();
    _auth.run();
})
