$(document).ready(function () {



    $('#loginForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },

        errorClass: 'error-red'

    });

    $('#registerForm').validate({
       rules: {
           username: {
               required: true,
                minlength: 2
           },

           email: {
               required: true,
               email: true
           },

           password: {
               required: true,
               minlength: 5
           },

           password_confirmation: {
               required: true,
               equalTo: '#password',
               minlength: 5
           }
       },

       errorClass: 'error-darkred'
    });

});