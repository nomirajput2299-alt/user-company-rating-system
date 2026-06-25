$(document).ready(function () {
    $("#contactUsForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            email: {
                required: true,
                email: true,
            },
            phoneNumber: {
                required: true,
                minlength: 10,
                maxlength: 15,
            },
            subject: {
                required: true,
                minlength: 3,
                maxlength: 20,
            },
            message: {
                required: true,
                minlength: 10,
                maxlength: 5000,
            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name must be at least 3 characters",
            },
            email: {
                required: "Email is required",
                email: "Enter a valid email",
            },
            phoneNumber: {
                required: "Phone number is required",
            },
            subject: {
                required: "Subject is required",
                minlength: "Subject must be at least 3 characters",
                maxlength: "Subject must be at least 20 characters",
            },
            message: {
                required: "Message is required",
                minlength: "Message must be at least 10 characters",
                maxlength: "Message must be at least 5000 characters",
            },
        },
        errorClass: "text-danger",
        errorElement: "small",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
    });
});
