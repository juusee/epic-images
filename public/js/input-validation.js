$(document).ready(function () {

    $('#commentForm').validate({
        rules: {
            content: {
                required: true
            }
        },

        errorClass: 'error-darkred'
    });

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

        errorClass: 'error-darkred'

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

    $('#updateForm').validate({
        rules: {
            username: {
                required: true,
                minlength: 2
            },

            email: {
                required: true,
                email: true
            }
        },

        errorClass: 'error-darkred'
    });

});