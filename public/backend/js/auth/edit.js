$(document).ready(function () {

    //Custom validate for image format
    $.validator.addMethod(
        "imageExtension",
        function (value, element) {
            if (element.files.length === 0) {
                return true;
            }

            var extension = value.split(".").pop().toLowerCase();
            return ["jpg", "jpeg", "png", "JPG", "JPEG", "PNG"].includes(
                extension,
            );
        },
        "Only jpg, jpeg, png, files are allowed.",
    );

    // Validate image size (2MB)
    $.validator.addMethod(
        "maxFileSize",
        function (value, element, param) {
            if (element.files.length === 0) {
                return true;
            }

            return element.files[0].size <= param;
        },
        "Image size must not exceed 2MB.",
    );

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
            phoneNumber: {
                required: true,
                minlength: 10,
                maxlength: 15,
            },
            avatar: {
                imageExtension: true,
                maxFileSize: 2097152, // 2MB in bytes
            },
            roles: {
                required: true,

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
            avatar: {
                imageExtension: "Only jpg, jpeg, png files are allowed.",
                maxFileSize: "Image size must not exceed 2MB.",
            },
             roles: {
                required: "Role is required",
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
            if (
                element.attr("name") === "password" ||
                element.attr("name") === "password_confirmation"
            ) {
                error.insertAfter(element.closest(".input-group"));
            } else {
                error.insertAfter(element);
            }
        },
    });
});
