function confirmDeleteCategory(categoryId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this Category!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteMyCategory(categoryId);
        } else {
            Swal.fire("Cancelled", "Category is safe :)", "info");
        }
    });
}

function deleteMyCategory(categoryId) {
    $.ajax({
        url: "/admin/delete-category/" + categoryId,
        type: "DELETE",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Adjusted to use a meta tag for CSRF token
        },
        success: function (response) {
            console.log(response); // Log the response
            if (response.success) {
                // Adjusted to check response.success directly
                Swal.fire("Deleted!", response.message, "success").then(() => {
                    window.location.reload(); // Reload the page
                });
            } else {
                Swal.fire("Success", response.message, "success");
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error response:", xhr.responseText);
            console.error("Status:", status);
            console.error("Error:", error);
            Swal.fire(
                "Error",
                "Something went wrong. Please try again later.",
                "error",
            );
        },
    });
}
