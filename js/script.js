$(document).ready(function () {
  $("#dt").DataTable();

  // Tombol Auth
  $(".btn-ubah").on("click", function () {
    const id = $(this).data("id");
    const labelHidden = $("#labelHidden").val();

    if (id) {
      $("#mainModalLabel").html("Konfirmasi Edit Data Administrator");
      $(".modal-body p").html(
        "Masukkan password terlebih dahulu jika ingin mengedit data seorang Administrator"
      );

      if (labelHidden != "ubah") {
        $(".usernameLabel label").remove();
        $(".inputUsername input").remove();
        $(".passwordLabel label").remove();
        $(".inputPassword input").remove();

        $("#row .passwordLabel").append(
          "<label for='password' class='col-form-label'>Password</label>"
        );
        $("#row .inputPassword").append(
          "<input type='password' name='password' id='password' class='form-control' placeholder='Masukkan password' required>"
        );

        $("#labelHidden").attr("value", "ubah");
      }

      $(".modal-footer button[type=submit] span").html("Kirim");
      $(".modal-footer button[type=submit] i").attr("class", "fa fa-send");
      $(".modal-footer button[type=submit]").attr("name", "auth");
      $(".modal-content form").attr("action", "kelola.php?ubah=" + id);
    }
  });

  // Tombol
  $(".btn-login").on("click", function () {
    const labelHidden = $("#labelHidden").val();

    $("#mainModalLabel").html("Halaman Login Administrator");
    $(".modal-body p").html("Silahkan masukkan username dan password anda.");

    if (labelHidden != "login") {
      $(".usernameLabel label").remove();
      $(".inputUsername input").remove();
      $(".passwordLabel label").remove();
      $(".inputPassword input").remove();

      $("#row .usernameLabel").append(
        "<label for='username' class='col-form-label'>Username</label>"
      );
      $("#row .inputUsername").append(
        "<input type='text' name='username' id='username' class='form-control' placeholder='Masukkan username' required>"
      );

      $("#row .passwordLabel").append(
        "<label for='password' class='col-form-label'>Password</label>"
      );
      $("#row .inputPassword").append(
        "<input type='password' name='password' id='password' class='form-control' placeholder='Masukkan password' required>"
      );

      $("#labelHidden").attr("value", "login");
    }

    $(".modal-footer button[type=submit] span").html("Kirim");
    $(".modal-footer button[type=submit] i").attr("class", "fa fa-send");
    $(".modal-footer button[type=submit]").attr("name", "login");
  });
});

// Tombol Hapus
$(".btn-hapus").on("click", function () {
  const id = $(this).data("id");

  $("#mainModalLabel").html("Konfirmasi Hapus Data");
  $(".modal-body p").html("Apakah anda yakin ingin menghapus data berikut ?");

  $(".usernameLabel label").remove();
  $(".inputUsername input").remove();
  $(".passwordLabel label").remove();
  $(".inputPassword input").remove();
  $("#labelHidden").attr("value", "hapus");

  $(".modal-footer button[type=submit] span").html("Yakin");
  $(".modal-content form").attr("action", "proses.php?hapus=" + id);
});
