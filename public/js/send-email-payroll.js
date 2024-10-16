function submitForem(formElement) {
    const inputs = formElement.querySelectorAll(
        "input[required], textarea[required]"
    );

    let isValdi = true;
    inputs.forEach((input) => {
        if (input.value.trim() === "") {
            isValdi = false;

            input.classList.remove("border", "border-gray-300");
            input.style.borderColor = "red";
        } else {
            input.style.borderColor = "";
            input.classList.add("border", "border-gray-300");
        }
    });

    if (!isValdi) {
        Swal.fire({
            title: "Error",
            text: "Harap isi semua field yang diperlukan.",
            icon: "error",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK",
        });
        return;
    }
    Swal.fire({
        text: "Apakah Anda yakin akan mengirim email?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            var formData = new FormData(formElement);
            Swal.fire({
                title: "Loading...",
                text: "Please wait while we process your request.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
            $.ajax({
                type: "POST",
                url: "/mails/payrolls/send",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        title: "Succes",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                error: function (xhr) {
                    if (xhr.status === 500) {
                        Swal.fire({
                            title: "Error",
                            text: xhr.responseJSON.message,
                            icon: "warning",
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        for (var field in errors) {
                            var messages = errors[field];

                            for (var i = 0; i < messages.length; i++) {
                                var message = messages[i];
                                $("#error_" + field).text(message);
                            }
                        }
                    } else {
                        console.log(xhr.responseText);
                    }
                },
                complete: function () {
                   
                },
            });
        }
    });
}
