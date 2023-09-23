function mostrarSweetAlert(title, icon, text, timer = 1500) {
    Swal.fire({
      title: title,
      icon: icon,
      text: text,
      showConfirmButton: false,
      timer: timer
    });
  }


    /**
     * @param {String} titulo Texto que se muestra con fuente ampliada
     * @param {String} mensaje Contenido detallando la notificación
     * */
    function mostrarPregunta(titulo, mensaje) {
      return Swal.fire({
          title: titulo,
          text: mensaje,
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
          confirmButtonColor: '#007bff',
          cancelButtonColor: '#797D7F',
          footer: '3P Tecnologia'
        }).then((result) => {
          return result;
      });
    }

    // Mensaje de complete los campos faltantes
    function completeCampos(){
      Swal.fire({
        title: "Por favor, complete los campos",
        icon: "warning",
        confirmButtonColor: "#E43D2C",
    });

    }

    // Mensaje de registro exitoso
    function MsjRegistro(){
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Operación exitosa',
        showConfirmButton: false,
        timer: 1500
        })

    }

    // Toast finalizar contrato
    function toastFinalizar(mensaje){
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: mensaje
      })
    }


 
