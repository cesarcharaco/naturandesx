<!-- jquery latest version -->
<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/metisMenu.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>

<!-- Start datatable js -->
    <!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<!-- others plugins -->
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable3').DataTable();
    // $('#dataTable2_wrapper').DataTable();
  });
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