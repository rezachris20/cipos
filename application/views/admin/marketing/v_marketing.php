<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Data Marketing</h2>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">

            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Foto</th>
                <th>KTP</th>
                <th style="width:18%;text-align: center;">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
              foreach ($marketing as $k) {
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $k->nama ?></td>
                  <td><?php echo $k->nik ?></td>
                  <td><?php echo $k->alamat ?></td>
                  <td><?php echo $k->hp ?></td>
                  <td><?php echo $k->email ?></td>
                  <td><img src="assets/images/marketing/<?php echo $k->foto; ?>" width="50" height="50" alt="Image"></td>
                  <td><img src="assets/images/marketing/<?php echo $k->ktp; ?>" width="50" height="50" alt="Image"></td>
                  <td style="text-align: center;">
                    <a href="#tambahmarketing" title="Edit Data" data-toggle="modal" class="btn btn-round btn-info btn-sm" onclick="submit('<?php echo $k->id ?>')"><i class="fa fa-pencil"> Edit</i></a>

                    <a class="btn btn-round btn-danger btn-sm" title="Hapus Data" onclick="hapus('<?php echo $k->id ?>')"><i class="fa fa-trash-o"></i> Delete</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <a href="#tambahmarketing" data-toggle="modal" class="btn btn-primary btn-sm" onclick="submit('tambah')"><span class="glyphicon glyphicon-plus"></span> Tambah Marketing</a>

          <!--Modal Tambah Data-->
          <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="tambahmarketing">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Data Kustomer</h4>
                  <center>
                    <font color="red">
                      <p id="pesan"></p>
                    </font>
                  </center>
                </div>
                <div class="modal-body">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">NIK :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nik" name="nik" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="alamat" name="alamat" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. HP :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hp" name="hp" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto :</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" id="uploadfoto" name="uploadfoto" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">KTP :</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" id="uploadktp" name="uploadktp" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="btn-edit">Edit</button>
                      <button type="button" class="btn btn-primary" id="simpan">Tambah</button>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- End Modal Tambah Data -->
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $("#simpan").click(function() {
      if (($("#nama").val() == "") || ($("#nik").val() == "") || ($("#alamat").val() == "") || ($("#hp").val() == "") || ($("#email").val() == "")) {
        swal("Form Harus Lengkap!", "Silahkan lengkapi nama, nik, alamat, hp, email", "error");
      } else {

        const uploadfoto = $("#uploadfoto").prop('files')[0];
        const uploadktp = $("#uploadktp").prop('files')[0];

        let formData = new FormData();
        formData.append('nama', $("#nama").val());
        formData.append('nik', $("#nik").val());
        formData.append('alamat', $("#alamat").val());
        formData.append('hp', $("#hp").val());
        formData.append('email', $("#email").val());
        formData.append('uploadfoto', uploadfoto);
        formData.append('uploadktp', uploadktp);

        $.ajax({
          type: 'POST',
          url: '<?php echo base_url() . 'marketing/submit_data' ?>',
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          success: function(msg) {
            $("#tambahmarketing").modal('hide');
            swal("Selesai!", "Data berhasil di tambah", "success");
            window.setTimeout(function() {
              window.location.href = "marketing";
            }, 2700);
          },
          error: function() {
            swal("Gagal!", "Data gagal di tambah", "error");
          }
        })
      }
    })

    $("#btn-edit").click(function() {
      if (($("#nama").val() == "") || ($("#nik").val() == "") || ($("#alamat").val() == "") || ($("#hp").val() == "") || ($("#email").val() == "")) {
        swal("Form Harus Lengkap!", "Silahkan lengkapi nama, nik, alamat, hp, email", "error");
      } else {

        const uploadfoto = $("#uploadfoto").prop('files')[0];
        const uploadktp = $("#uploadktp").prop('files')[0];

        let formData = new FormData();
        formData.append('id', $("#id").val());
        formData.append('nama', $("#nama").val());
        formData.append('nik', $("#nik").val());
        formData.append('alamat', $("#alamat").val());
        formData.append('hp', $("#hp").val());
        formData.append('email', $("#email").val());
        formData.append('uploadfoto', uploadfoto);
        formData.append('uploadktp', uploadktp);

        $.ajax({
          type: 'POST',
          url: '<?php echo base_url() . 'marketing/editdata' ?>',
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          success: function(msg) {
            $("#tambahmarketing").modal('hide');
            swal("Selesai!", "Data berhasil di tambah", "success");
            window.setTimeout(function() {
              window.location.href = "marketing";
            }, 2700);
          },
          error: function() {
            swal("Gagal!", "Data gagal di tambah", "error");
          }
        })
      }
    })
  })

  function submit(x) {
    if (x == "tambah") {
      $("#simpan").show();
      $("#btn-edit").hide();
    } else {
      $("#simpan").hide();
      $("#btn-edit").show();

      $.ajax({
        type: 'POST',
        data: 'id=' + x,
        url: '<?php echo base_url() . 'marketing/ambilid' ?>',
        dataType: 'json',
        success: function(hasil) {
          $("[name = 'id']").val(hasil[0].id);
          $("[name = 'nama']").val(hasil[0].nama);
          $("[name = 'nik']").val(hasil[0].nik);
          $("[name = 'alamat']").val(hasil[0].alamat);
          $("[name = 'hp']").val(hasil[0].hp);
          $("[name = 'email']").val(hasil[0].email);
        }
      });
    }
  }

  function editData() {
    var id = $("[name='id']").val();
    var nama = $("[name='nama']").val();
    var alamat = $("[name='alamat']").val();
    var hp = $("[name='hp']").val();
    var email = $("[name='email']").val();

    $.ajax({
      type: 'POST',
      data: 'id=' + id + '&nama=' + nama + '&alamat=' + alamat + '&hp=' + hp + '&email=' + email,
      url: '<?php echo base_url() . 'kustomer/editdata' ?>',
      dataType: 'json',
      success: function(hasil) {
        $("#pesan").html(hasil.pesan);

        if (hasil.pesan == "") {
          $("#tambahmarketing").modal('hide');
          swal("Selesai!", "Data berhasil di ubah", "success");
          window.setTimeout(function() {
            window.location.href = "kustomer";
          }, 2700);
        }
      }
    });
  }

  function hapus(id) {
    swal({
      title: "Apakah anda yakin ?",
      text: "Anda tidak dapat mengembalikan file yang sudah di hapus",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6855",
      confirmButtonText: "Ya, Hapus !",
      closeOnConfirm: false
    }, function(isConfirm) {

      if (!isConfirm) return;

      $.ajax({
        type: 'POST',
        data: 'id=' + id,
        url: '<?php echo base_url() . 'marketing/hapusdata' ?>',
        success: function() {
          swal("Selesai!", "File sudah terhapus", "success");
          window.setTimeout(function() {
            window.location.href = 'marketing';
          }, 2700);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          swal("Error deleting", "Please try again", "error");
        }
      });
    });
  }
</script>