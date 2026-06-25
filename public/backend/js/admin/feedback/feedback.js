$(document).ready(function () {
    // -- Load the Data list --
    var table = $("#feedbackTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: listUrl,

        order: [[0, "desc"]], // Order by ID DESC
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
                data: "subject",
                name: "subject",
            },
            {
                data: "message",
                name: "message",
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

    // -- Delete --
    $(document).on("click", ".delete", function () {
        let url = $(this).data("action");

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this feedback!!",
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
                        _token: globalCsrf,
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire("Delete!", response.message, "success");
                        } else {
                            Swal.fire("Error!", response.message, "error");
                        }
                        // Refresh DataTable
                        $("#feedbackTable")
                            .DataTable()
                            .ajax.reload(null, false);
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
                        $("#feedbackTable")
                            .DataTable()
                            .ajax.reload(null, false);
                    },
                });
            }
        });
    });
});
