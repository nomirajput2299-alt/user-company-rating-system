$(document).ready(function () {
    // -- Load the Data list --
    var table = $("#userTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: listUrl,

        columns: [
            {
                data: "id",
                name: "id",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "phoneNumber",
                name: "phoneNumber",
            },
            {
                data: "avatar",
                name: "avatar",
            },
            {
                data: "roles",
                name: "roles",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    // -- Toggle Status --
    $(document).on("change", ".toggle-status", function () {
        let checkbox = $(this);
        let url = $(this).data("action");
        let newStatus = $(this).is(":checked");

        Swal.fire({
            title: "Are you sure?",
            text: "You want to change user status!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: globalCrsf,
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire("Updated!", response.message, "success");
                        } else {
                            Swal.fire("Error!", response.message, "error");
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr);
                        let message = "Something went wrong.";
                        if (xhr.responseText) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                message = response.message;
                            } catch (e) {
                                console.log(e);
                            }
                        }

                        // revert checkbox if error
                        checkbox.prop("checked", !newStatus);

                        Swal.fire("Error!", message, "error");
                    },
                });
            } else {
                // revert if cancelled
                $(this).prop("checked", !newStatus);
            }
        });
    });

    // -- Toggle Role --
    $(document).on("focus", ".user-role", function () {
        $(this).data("previous", $(this).val());
    });

    // Change role
    $(document).on("change", ".user-role", function () {
        let select = $(this);
        let userId = select.data("id");
        let newRole = select.val();
        let oldRole = select.data("previous");

        Swal.fire({
            title: "Are you sure?",
            text: "You want to change user role!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: changeRoleUrl,
                    type: "PUT",
                    data: {
                        _token: globalCrsf,
                        userId: userId,
                        newRole: newRole,
                    },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire("Updated!", response.message, "success");
                            select.data("previous", newRole);
                        } else {
                            select.val(oldRole);
                            Swal.fire("Error!", response.message, "error");
                        }
                    },
                    error: function (xhr) {
                        select.val(oldRole);

                        let message = "Something went wrong.";

                        if (xhr.responseJSON?.message) {
                            message = xhr.responseJSON.message;
                        }

                        Swal.fire("Error!", message, "error");
                    },
                });
            } else {
                // Revert dropdown value on cancel
                select.val(oldRole);
            }
        });
    });

    // -- Delete --
    $(document).on("click", ".delete", function () {
        let url = $(this).data("action");

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this user!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "DElETE",
                    data: {
                        _token: globalCrsf,
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire("Delete!", response.message, "success");
                        } else {
                            Swal.fire("Error!", response.message, "error");
                        }
                        // Refresh DataTable
                        $("#userTable").DataTable().ajax.reload(null, false);
                    },
                    error: function (xhr) {
                        console.log(xhr);
                        let message = "Something went wrong.";
                        if (xhr.responseText) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                message = response.message;
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        Swal.fire("Error!", message, "error");
                        $("#userTable").DataTable().ajax.reload(null, false);
                    },
                });
            }
        });
    });
});
