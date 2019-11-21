$( document ).ready(function() {
    // Two functions to determine caps lock state.
    // Requires two as for some reason keydown won't detect caps off and keyup won't detect caps on.
    var password = $('#password');
    password.keydown(function (e) {
        if (e.originalEvent.getModifierState("CapsLock")) {
            $('#login-caps-lock-warning-icon').show();
        } else {
            $('#login-caps-lock-warning-icon').hide();
        }
    });

    password.keyup(function (e) {
        if (e.originalEvent.getModifierState("CapsLock")) {
            $('#login-caps-lock-warning-icon').show();
        } else {
            $('#login-caps-lock-warning-icon').hide();
        }
    });

});