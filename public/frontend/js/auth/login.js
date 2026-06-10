$(document).ready(function () {
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
        },

        messages: {
            email: {
                required: "Email is required",
                email: "Please enter a valid email address",
            },
            password: {
                required: "Password is required",
                minlength: "password must be at least 6 characters",
            },
        },

        errorElement: "small",
        errorClass: "text-danger",

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
    });
});
