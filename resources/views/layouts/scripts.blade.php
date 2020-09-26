<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" defer></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" defer></script><!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- dataTables -->
<script src="{{ asset('plugins/dataTables/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('plugins/dataTables/dataTables.bootstrap4.min.js') }}" defer></script>
<script src="{{ asset('plugins/dataTables/dataTables.responsive.min.js') }}" defer></script>
<script src="{{ asset('plugins/dataTables/responsive.bootstrap4.min.js') }}" defer></script>



<script type="text/javascript">
  $(function () {
        $("[rel='tooltip']").tooltip();
    });
  $(function () {
    $('#example').tooltip(options)
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#dataTable3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $(document).ready(function() {
    //DATOS DE LAS PREGUNTAS
    var opcion=1;
    $.get("buscar_preguntas/1/seguridad",function (data) {
      })
      .done(function(data) {
        if (data.length>0) {
          for (var i = 0; i < data.length; i++) {
            $('#selectPreguntas').append('<option value="'+data[i].id+'">'+data[i].pregunta+'</option>');
          }
        }else{
          alert('Sin resultados');
        }
      });
    });

  function vistaMenuLateral(opcion) {
    if (opcion == 1) {
      $('#vistaReportes').show();
      $('#vistaPerfil').hide();
    }else{
      $('#vistaReportes').hide();
      $('#vistaPerfil').show();
    }
  }

  function editarPerfil(opcion) {
    if (opcion == 1) {
      $('.editPerfil').fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('.verDatosPerfil').fadeIn(300);
          });
    }else{
      $('.verDatosPerfil').fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('.editPerfil').fadeIn(300);
          });
    }
  }


  function VerR(opcion) {
    $('#Inputrespuesta').removeAttr('type',false);
    $('#Inputrespuesta').attr('type','text');
  }


  function opcionesTabla(tipo,id) {
      if (tipo == 1) {
          $('#vista1-'+id).fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('#vista2-'+id).fadeIn(300);
          });
          $('#th1').fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('#th2').fadeIn(300);
          });
          $('#th1-2').fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('#th2-2').fadeIn(300);
          });
      //class
          $('.vista1-'+id).fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('.vista2-'+id).fadeIn(300);
          });
          $('.th1').fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('.th2').fadeIn(300);
          });
      }else{
          $('#vista2-'+id).fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('#vista1-'+id).fadeIn(300);
          });
          $('#th2').fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('#th1').fadeIn(300);
          });
          $('#th2-2').fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('#th1-2').fadeIn(300);
          });
      //class
          $('.vista2-'+id).fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('.vista1-'+id).fadeIn(300);
          });
          $('.th2').fadeOut('slow',
              function() { 
                  $(this).hide();
                  $('.th1').fadeIn(300);
          });
      }
  }
</script>
@yield('scripts')