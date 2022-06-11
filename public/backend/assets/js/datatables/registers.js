(function ($) {
  "use strict";

  var registers_table = $("#registers_table").DataTable({
    processing: true,
    serverSide: true,
    dom: 'Bfrtip',
        buttons: [
            'copy', 
            'csv',
            {
              extend: 'excelHtml5',
              exportOptions: {
                  columns: [ 0, 1, 2, 4, 5, 6 ]
              }
            }, 
            {
              extend: 'pdfHtml5',
              exportOptions: {
                  columns: [ 0, 1, 2, 4, 5, 6 ]
              }
            }, 
            'print',
            'colvis'
        ],
    ajax: {
      url: _url + "/admin/registers/get_table_data",
      method: "POST",
      data: function (d) {
        d._token = $('meta[name="csrf-token"]').attr("content");

        if ($("select[name=status]").val() != "") {
          d.status = $("select[name=status]").val();
          
        }
        if ($("select[name=age]").val() != "") {
          d.age = $("select[name=age]").val();
          
        }
        if ($("select[name=currency]").val() != "") {
          d.currency = $("select[name=currency]").val();
        }
        if ($("select[name=branch]").val() != "") {
          d.branch = $("select[name=branch]").val();
        } 
      },
      error: function (request, status, error) {
        console.log(request.responseText);
      },
    },
    columns: [
      { data: "name", name: "name" },
      { data: "interest_rate", name: "interest_rate" },
      { data: "disbursements", name: "disbursements" },
      { data: "repayments", name: "repayments" },
      { data: "total_loans", name: "total_loans" },
      { data: "book_value", name: "book_value" },  
      { data: "branch", name: "branch" },  
    ],
    responsive: true,
    searching: false,
    bStateSave: true,
    bAutoWidth: false,
    ordering: false,
    language: {
      decimal: "",
      emptyTable: $lang_no_data_found,
      info:
        $lang_showing +
        " _START_ " +
        $lang_to +
        " _END_ " +
        $lang_of +
        " _TOTAL_ " +
        $lang_entries,
      infoEmpty: $lang_showing_0_to_0_of_0_entries,
      infoFiltered: "(filtered from _MAX_ total entries)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: $lang_show + " _MENU_ " + $lang_entries,
      loadingRecords: $lang_loading,
      processing: $lang_processing,
      search: $lang_search,
      zeroRecords: $lang_no_matching_records_found,
      paginate: {
        first: $lang_first,
        last: $lang_last,
        previous: "<i class='icofont-rounded-left'></i>",
        next: "<i class='icofont-rounded-right'></i>",
      },
    },
    drawCallback: function () {
      $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
    },
  });

  $(".select-filter").on("change", function (e) {
    registers_table.draw();
  });

  $(document).on("ajax-screen-submit", function () {
    registers_table.draw();
  }); 

})(jQuery);
