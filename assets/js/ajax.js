$(document).ready(function(){

  /*============*/
  /*====Calon===*/
  /*============*/
  $('#loading').hide();
  $('#btn-tambah').click(function(){
    $('#btn-ubah').hide();
    $('#btn-simpan').show();
    $('#modal-title').html('Form Tambah Data');
    $("#form input, #form textarea").val(""); 
    $('#preview').attr('src', '');
  });

  $('#modal-form').on('hidden.bs.modal', function (e) {
    $("#form input, #form textarea").val(""); 
    $('#preview').attr('src', '');
    tinymce.get('visi').setContent('');
    tinymce.get('misi').setContent('');
  })

  // Tambah Calon
  $('#btn-simpan').click(function(){
    var n = $('#nama').val();
    var k = $('#kelas').val();
    var o = $('#organisasi').val();
    var v = $('#visi').val();
    var m = $('#misi').val();
    var f = $('#foto').val();
    
    if( n == '' || k == '' || o == '' || f == '' ){
      swal("Oops...", "Form tidak boleh ada yang kosong!", "error");
    }else{
      tinymce.triggerSave();
      var data = new FormData();

      data.append('nama', $('#nama').val());
      data.append('kelas', $('#kelas').val());
      data.append('organisasi', $('#organisasi').val());
      data.append('visi', $('#visi').val());
      data.append('misi', $('#misi').val());

      data.append('type', 'insert');

      data.append('foto', $("#foto")[0].files[0]);

      $('#loading').show();
      $.ajax({
        url         : 'ajax/calon.php',
        type        : 'POST',
        data        : data,
        processData : false,
        contentType : false,
        dataType    : 'json',
        beforeSend  : function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success     : function(response){ 
          $("#loading").hide(); 
          
          if(response.status == "sukses"){ 
            $("#view").html(response.html);
            swal("Good job!", "Data berhasil disimpan", "success");
            $("#form input, #form textarea").val(""); 
            $('#preview').attr('src', '');
            $("#modal-form").modal('hide');
          }else{ 
            swal("Oops...", "Ada yang error!", "error");
          }
        },
        error       : function (xhr, ajaxOptions, thrownError) {
          alert("ERROR : "+xhr.responseText); 
        }
      });
    }

  });

  // Ubah data Calon
  $('#btn-ubah').click(function(){
    var n = $('#nama').val();
    var k = $('#kelas').val();
    var o = $('#organisasi').val();
    var v = $('#visi').val();
    var m = $('#misi').val();
    
    if( n == '' || k == '' || o == '' ){
      swal("Oops...", "Form tidak boleh ada yang kosong!", "error");
    }else{
      tinymce.triggerSave();
      var data = new FormData();

      data.append('nama', $('#nama').val());
      data.append('kelas', $('#kelas').val());
      data.append('organisasi', $('#organisasi').val());
      data.append('visi', $('#visi').val());
      data.append('misi', $('#misi').val());

      data.append('data-id', $('#data-id').val());
      data.append('data-foto', $('#data-foto').val());

      data.append('type', 'update');

      data.append('foto', $("#foto")[0].files[0]);

      $('#loading').show();
      $.ajax({
        url         : 'ajax/calon.php',
        type        : 'POST',
        data        : data,
        processData : false,
        contentType : false,
        dataType    : 'json',
        beforeSend  : function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success     : function(response){ 
          $("#loading").hide(); 
          
          if(response.status == "sukses"){ 
            $("#view").html(response.html);
            swal("Good job!", "Data berhasil diubah", "success");
            $("#form input, #form textarea").val(""); 
            $('#preview').attr('src', '');
            $("#modal-form").modal('hide'); 
          }else{ 
            swal("Oops...", "Ada yang error!", "error");
          }
        },
        error       : function (xhr, ajaxOptions, thrownError) {
          alert("ERROR : "+xhr.responseText); 
        }
      });
    }

  });

  // Hapus Calon
  $("#btn-hapus").click(function(){ 
    
    var data = new FormData();
    data.append('data-id', $('#data-id').val());
    data.append('data-foto', $('#data-foto').val());
    data.append('type', 'delete');
    
    $("#load").show(); 
    
    $.ajax({
      url: 'ajax/calon.php',
      type: 'POST',
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#load").hide(); 
        $("#view").html(response.html);
        swal("Good job!", "Data berhasil dihapus", "success");
        $("#modal-hapus").modal('hide');
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert("ERROR : "+xhr.responseText); 
      }
    });
  });

  // Hapus Semua Calon
  $('#hapusSemua').click(function(){
    $('#konfirmasi').html('Apakah anda yakin ingin menghapus semua data ini?');
    $('#btn-hapus').hide();
    $('#btn-hapusSemua').show();
    $('#load').hide();
  });
  // Hapus Semua Calon
  $("#btn-hapusSemua").click(function(){ 
    
    var data = new FormData();
    data.append('type', 'deleteAll');
    
    $("#load").show(); 
    
    $.ajax({
      url: 'ajax/calon.php',
      type: 'POST',
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#load").hide(); 
        $("#view").html(response.html);
        swal("Good job!", "Data berhasil dihapus", "success");
        $("#modal-hapus").modal('hide');
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert("ERROR : "+xhr.responseText); 
      }
    });
  });


  /*============*/
  /*====Data====*/
  /*============*/
  // Upload Data Pemilih
  $('#btn-upload').click(function(){
    
    var file = $('#file').val();
    if ( file == '' ) {
      swal("Oops...", "Form tidak boleh kosong!", "error");   
    }else{
      function hasExtension(inputID, exts) {
        var fileName = document.getElementById(inputID).value;
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
      }

      if(!hasExtension('file', ['.xls', '.xlsx'])){
        swal("Oops...", "File .XLS/.XLSX yang diizinkan!!", "error");
      }else{
        var data = new FormData();
        data.append('file', $('#file')[0].files[0]);
        data.append('type', 'insert');
        $('#loading').show();

        $.ajax({
          url         : 'ajax/data.php',
          type        : 'POST',
          data        : data,
          processData : false,
          contentType : false,
          dataType    : 'json',
          beforeSend  : function(e) {
            if(e && e.overrideMimeType) {
              e.overrideMimeType("application/json;charset=UTF-8");
            }
          },
          success     : function(response){ 
            $("#loading").hide(); 
            
            if(response.status == "sukses"){ 
              $("#view-data").html(response.html);
              swal("Good job!", "Data berhasil diupload", "success");
              $("#form input").val(""); 
              $("#modal-tambah").modal('hide'); 
            }else{ 
              swal("Oops...", "Ada yang error!", "error");
            }
          },
          error       : function (xhr, ajaxOptions, thrownError) {
            // alert("ERROR : "+xhr.responseText); 
            location.reload();
          }
        });
      }
    }

  });

  // Hapus Semua Data Pemilih
  $('#load').hide();
  $("#btn-hapusData").click(function(){ 
    
    var data = new FormData();
    data.append('type', 'delete');
    
    $("#load").show(); 
    
    $.ajax({
      url: 'ajax/data.php',
      type: 'POST',
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#load").hide(); 
        $("#view-data").html(response.html);
        swal("Good job!", "Data berhasil dihapus", "success");
        $("#modal-hapus").modal('hide');
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert("ERROR : "+xhr.responseText); 
      }
    });
  });

  /*============*/
  /*====Pilih===*/
  /*============*/
  // Login
  $('#btn-login').click(function(){
    var nm = $('#nama').val();
    var ns = $('#nis').val()
    if (nm == '' || ns == '') {
      swal("Oops...", "Nama dan NIS tidak boleh kosong!", "error");
    }else{
      var data = new FormData();
      data.append('nama', $('#nama').val());
      data.append('nis', $('#nis').val());
      data.append('type', 'login');

      $.ajax({
        url         : 'ajax/pilih.php',
        type        : 'POST',
        data        : data,
        processData : false,
        contentType : false,
        dataType    : 'json',
        beforeSend  : function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success     : function(response){ 
          if(response.status == "ada"){ 
            document.location="index.php";
          }else{ 
            swal("Oops...", "Nama atau NIS anda salah / anda sudah memilih", "error");
            return false;
          }
        },
        error       : function (xhr, ajaxOptions, thrownError) {
          alert("ERROR : "+xhr.responseText); 
        }
      });
    }

  });

  // Proses Pilih
  $('#btn-pilih').click(function(){

    $('#btn-pilih').hide();

    var data = new FormData();
    data.append('id_calon', $('#id-calon').val());
    data.append('type', 'pilih');

    $.ajax({
      url         : 'ajax/pilih.php',
      type        : 'POST',
      data        : data,
      processData : false,
      contentType : false,
      dataType    : 'json',
      beforeSend  : function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success     : function(response){ 
        if(response.status == "sukses"){ 
          swal({
            title: "Good job!",
            text: "Terima Kasih",
            type:"success"
          }, 
          function(){
            document.location='index.php';
          });
        }else{ 
          swal("Oops...", "Ada yang Error!", "error");
          return false;
        }
      },
      error       : function (xhr, ajaxOptions, thrownError) {
        alert("ERROR : "+xhr.responseText); 
      }
    });

  });

  /*============*/
  /*====Admin===*/
  /*============*/
  $('#loadingTambah').hide();
  $('#loadingUbah').hide();
  $('#loadingHapus').hide();
  // Tambah Admin
  $('#btn-tambahAdmin').click(function(){
    var n = $('#namaAdmin').val();
    var u = $('#user').val();
    var p = $('#pass').val();
    
    if( n == '' || u == '' || p == '' ){
      swal("Oops...", "Form tidak boleh kosong!", "error");
    }else{
      var data = new FormData();

      data.append('nama', $('#namaAdmin').val());
      data.append('user', $('#user').val());
      data.append('pass', $('#pass').val());
      data.append('mail', $('#mail').val());

      data.append('type', 'insert');

      $('#loadingTambah').show();
      $.ajax({
        url         : 'ajax/admin.php',
        type        : 'POST',
        data        : data,
        processData : false,
        contentType : false,
        dataType    : 'json',
        beforeSend  : function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success     : function(response){ 
          $("#loadingTambah").hide(); 
          
          if(response.status == "sukses"){ 
            $("#view-admin").html(response.html);
            swal("Good job!", "Data berhasil disimpan", "success");
            $("#formtambah input").val(""); 
          }else if(response.status == "nama"){ 
            swal("Oops...", "Username sudah ada", "error");
          }else if(response.status == "gagal"){ 
            swal("Oops...", "Ada yang error!", "error");
          }
        },
        error       : function (xhr, ajaxOptions, thrownError) {
          alert("ERROR : "+xhr.responseText); 
        }
      });
    }

  });

  $('#passSalah').hide();

  $('#edit').on('hidden.bs.modal', function (e) {
    $('#formubah input').val('');
    $('#passSalah').hide();
    $('#passwordverif').css('border-color', '#d2d6de');
  })

  // Ubah Admin
  $('#btn-ubahAdmin').click(function(){
    var n = $('#nameAdmin').val();
    var u = $('#username').val();
    var pl = $('#passwordlama').val();
    var pb = $('#passwordbaru').val();
    var pv = $('#passwordverif').val();
    
    if( n == '' || u == '' || pl == '' || pb == '' || pv == '' ){
      swal("Oops...", "Form tidak boleh kosong!", "error");
    }else{
      if( pb == pv ){
        var data = new FormData();

        data.append('id', $('#idAdmin').val());
        data.append('nama', $('#nameAdmin').val());
        data.append('user', $('#username').val());
        data.append('passL', $('#passwordlama').val());
        data.append('passB', $('#passwordbaru').val());
        data.append('mail', $('#email').val());

        data.append('type', 'update');

        $('#loadingUbah').show();
        $.ajax({
          url         : 'ajax/admin.php',
          type        : 'POST',
          data        : data,
          processData : false,
          contentType : false,
          dataType    : 'json',
          beforeSend  : function(e) {
            if(e && e.overrideMimeType) {
              e.overrideMimeType("application/json;charset=UTF-8");
            }
          },
          success     : function(response){ 
            $("#loadingUbah").hide(); 
            
            if(response.status == "sukses"){ 
              $("#view-admin").html(response.html);
              swal("Good job!", "Data berhasil diubah", "success");
              $("#formubah input").val("");
              $("#edit").modal('hide');
            }else if(response.status == "gagal"){ 
              swal("Oops...", "Ada yang error!", "error");
            }else if(response.status == "pass"){
              swal("Oops...", "Password lama salah!", "error");
            }
          },
          error       : function (xhr, ajaxOptions, thrownError) {
            alert("ERROR : "+xhr.responseText); 
          }
        });
      }else{
        $('#passwordverif').css('border-color', 'red');
        $('#passSalah').css('color', 'red');
        $('#passSalah').show();
      }
    }

  });

  // Hapus Admin
  $('#btn-hapusAdmin').click(function(){

    var data = new FormData();
    data.append('id', $('#id-val').val());
    data.append('type', 'delete');
    
    $("#loadingHapus").show(); 
    
    $.ajax({
      url: 'ajax/admin.php',
      type: 'POST',
      data: data, 
      processData: false,
      contentType: false,
      dataType: "json",
      beforeSend: function(e) {
        if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
        }
      },
      success: function(response){ 
        $("#loadingHapus").hide();
        if(response.status == "sukses"){ 
          $("#view-admin").html(response.html);
          swal("Good job!", "Data berhasil dihapus", "success");
          $("#hapus").modal('hide'); 
        }else{ 
          swal("Oops...", "Tidak boleh dihapus!!", "error");
        }
      },
      error: function (xhr, ajaxOptions, thrownError) { 
        alert("ERROR : "+xhr.responseText); 
      }
    });

  });

});