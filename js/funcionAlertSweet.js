function mostrarSweetAlert(title, icon, text, timer = 1500) {
    Swal.fire({
      title: title,
      icon: icon,
      text: text,
      showConfirmButton: false,
      timer: timer
    });
  }
