function alertSimpan(param) {
    if (param == 'S') {
        Swal.fire({
            customClass: {
                confirmButton: 'bg-green',
                cancelButton: 'bg-white',
            },
            title: 'Data Berhasil Disimpan ! ',
            icon: 'success',
            confirmButtonText: 'OK',
        })
    } else {
        Swal.fire({
            customClass: {
                confirmButton: 'bg-red',
                cancelButton: 'bg-white',
            },
            title: 'Data Gagal Disimpan ! ',
            icon: 'error',
            confirmButtonText: 'OK',
        })
    }
}

function alertHapus(param) {
    if (param == 'S') {
        Swal.fire({
            customClass: {
                confirmButton: 'bg-green',
                cancelButton: 'bg-white',
            },
            title: 'Data Berhasil Dihapus ! ',
            icon: 'success',
            confirmButtonText: 'OK',
        })
    } else {
        Swal.fire({
            customClass: {
                confirmButton: 'bg-red',
                cancelButton: 'bg-white',
            },
            title: 'Data Gagal Dihapus ! ',
            icon: 'error',
            confirmButtonText: 'OK',
        })
    }
}

function alertCustom(param, titleP, textP = '') {
    if (param == 'S') {
        Swal.fire({
            customClass: {
                confirmButton: 'bg-green',
                cancelButton: 'bg-white',
            },
            title: titleP,
            text: textP,
            icon: 'success',
            confirmButtonText: 'OK',
        })
    } else if (param == 'W') {
        Swal.fire({
            customClass: {
                confirmButton: 'bg-yellow',
                cancelButton: 'bg-white',
            },
            title: titleP,
            text: textP,
            icon: 'warning',
            confirmButtonText: 'OK',
        })
    } else {
        Swal.fire({
            customClass: {
                confirmButton: 'bg-red',
                cancelButton: 'bg-white',
            },
            title: titleP,
            text: textP,
            icon: 'error',
            confirmButtonText: 'OK',
        })
    }
}

async function alertConfirm(title, text = '', klas = "bg-red") {
    const result = await Swal.fire({
        customClass: {
            confirmButton: klas,
            cancelButton: 'bg-white',
        },
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
    });

    return result.isConfirmed;
}