const Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    iconColor: 'white',
    customClass: {
      popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true
  })

  function RemoveErrorsFields(form){
    $(form).each(function () {
        let input = $(this).find(':input');
        input.hasClass('is-invalid') ? input.removeClass('is-invalid') :'';
    });
}

function myAjax(url, method, form, data = '') {
    let request = $.ajax({
        url: url,
        method: method,
        dataType: 'json',
        data: data,
        async: false
    });
    request.done(function(data) {

        RemoveErrorsFields(form);

        Toast.fire({
            icon: 'success',
            title: data.message
          })
    });
    request.fail(function(jqXHR, textStatus, errorThrown) {
        if( jqXHR.status === 401 )
            $( location ).prop( 'pathname', 'auth/login' );

        if( jqXHR.status === 422 ) {

            RemoveErrorsFields(form);

            let $errors = jqXHR.responseJSON.errors;

            $.each($errors, function( key, value ) {
                let input = $(form).find(`[name=${key}]`);

                $(input).addClass('is-invalid')
                    .parent()
                    .find('.invalid-feedback>strong')
                    .text(value)
                    .next('span.invalid-feedback');
            });

            Toast.fire({
                icon: 'error',
                title: 'Oops...'
                })
        }
        else{
            Toast.fire({
                icon: 'error',
                title: 'There was something really wrong'
                })
        }

    });
    return true;
}

function deleteInfo(url, $mytable) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let request = $.ajax({
                url: url,
                type: 'delete',
                dataType: 'json',
            });
            request.done(function (data) {
                Toast.fire({
                    icon: 'success',
                    title: data.message
                })
                $mytable.draw();
            });
            request.fail(function (jqXHR, textStatus, errorThrown) {
                Swal.fire('Failed!', "There was something wrong", "warning");
            });
        }
    });
    return true;
}

