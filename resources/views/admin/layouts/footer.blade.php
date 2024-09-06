  <!-- BEGIN: Footer-->
  <footer class="footer footer-static footer-light">
      <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2024<a
                  class="ms-25" href="#" target="_blank"></a><span
                  class="d-none d-sm-inline-block">{{ __('general.copyright') }}</span></span></p>
  </footer>
  <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
  <!-- END: Footer-->
  <!-- BEGIN: Vendor JS-->
  <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
  <!-- BEGIN Vendor JS-->

  <!-- BEGIN: Page Vendor JS-->
  <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script> --}}
  <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/forms/cleave/cleave.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
  <!-- END: Page Vendor JS-->

  <!-- BEGIN: Theme JS-->
  <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
  <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
  <!-- END: Theme JS-->

  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <!-- BEGIN: Page JS-->
  <script src="{{ asset('app-assets/js/scripts/pages/app-user-list.js') }}"></script>
  <script src="{{ asset('app-assets/js/scripts/pages/modal-add-role.js') }}"></script>
  <script src="{{ asset('app-assets/js/scripts/pages/app-access-roles.js') }}"></script>
  <script src="{{ asset('app-assets/js/scripts/pages/page-account-settings-account.js') }}"></script>
  <script src="{{ asset('app-assets/js/scripts/components/components-dropdowns.js') }}"></script>
  <!-- END: Page JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

  <script>
      $(window).on('load', function() {
          if (feather) {
              feather.replace({
                  width: 14,
                  height: 14
              });
          }
      });
      $('.datatable').dataTable({});
  </script>
  {{-- <script>
      document.addEventListener("DOMContentLoaded", function() {
          var dropdownButton = document.querySelector(".dropdown .btn.dropdown-toggle");
          var dropdownMenu = document.querySelector(".dropdown-menu");

          dropdownButton.addEventListener("click", function(e) {
              e.stopPropagation();
              dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "block" : "block";
          });
          document.addEventListener("click", function(e) {
              if (e.target !== dropdownButton && e.target.closest(".dropdown") === null) {
                  dropdownMenu.style.display = "none";
              }
          });
      });
  </script> --}}
  @stack('js_scripts')
  </body>
  <!-- END: Body-->

  </html>
