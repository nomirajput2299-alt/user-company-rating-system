$(document).ready(function () {
    // Validation of Register form
    $("#editForm").validate({
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
            initial: {
                required: true,
                minlength: 2,
                maxlength: 2,
            },
            phoneNumber: {
                required: true,
                minlength: 10,
                maxlength: 15,
            },
            city: {
                required: true,
                minlength: 3,
                maxlength: 20,
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
            initial: {
                required: "Initial is required",
                minlength: "Initial must be at least 2 characters",
                maxlength: "Initial must be at most 2 characters",
            },
            phoneNumber: {
                required: "Phone number is required",
            },
            city: {
                required: "City is required",
                minlength: "City must be at least 3 characters",
                maxlength: "City must be at least 20 characters",
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
