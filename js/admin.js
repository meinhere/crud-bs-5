$(document).ready(function () {
  $('#table').DataTable();

  $('.role_checked').on('click', function () {
    $(this).toggleClass('checked');
    const role = $(this).attr('class');
    const parent = $(this).parent();

    console.log(parent);
    if (role == 'role_checked checked') {
      $('.ubah_checked').removeAttr('checked');
      $('.hapus_checked').removeAttr('checked');

      $('.ubah_checked').attr('disabled', 'true');
      $('.hapus_checked').attr('disabled', 'true');
    } else if (role == 'role_checked') {
      $('.ubah_checked').removeAttr('disabled');
      $('.hapus_checked').removeAttr('disabled');
    }
  });
});

function previewImg() {
  const foto = document.querySelector('#foto');
  const fotoSiswa = document.querySelector('.img-prev');

  const fileFoto = new FileReader();
  fileFoto.readAsDataURL(foto.files[0]);

  fileFoto.onload = function (e) {
    fotoSiswa.src = e.target.result;
  };
}
