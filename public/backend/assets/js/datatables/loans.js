(function ($) {
  "use strict";

  var loans_table = $("#loans_table").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: _url + "/admin/loans/get_table_data",
      method: "POST",
      data: function (d) {
        d._token = $('meta[name="csrf-token"]').attr("content");

        if ($("select[name=status]").val() != "") {
          d.status = $("select[name=status]").val();
        }
      },
      error: function (request, status, error) {
        console.log(request.responseText);
      },
    },
    order: [[0, "asc"]],
    columns: [
      { data: "release_date", name: "release_date" },
      { data: "borrower.name", name: "borrower.name" },  
      { data: "total_payable", name: "total_payable" }, 
      { data: "loan_id", name: "loan_id", orderable: true },
      { data: "loan_product.name", name: "loan_product.name" },         
      { data: "applied_amount", name: "applied_amount" },     
      { data: "status", name: "status" },
      { data: "action", name: "action" },
    ],
    responsive: true,
    scrollX: true,
    columnDefs: [
      { responsivePriority: 1, targets: 0},
      { responsivePriority: 2, targets: 1},
      { responsivePriority: 3, targets: 2},
      { responsivePriority: 4, targets: 7},
      { responsivePriority: 5, targets: 3, },  
      { responsivePriority: 6, targets: 4, },   
      { responsivePriority: 7, targets: 5, }, 
      { responsivePriority: 8, targets: 6, },    
    ],
    bStateSave: true,
    bAutoWidth: true,
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
    aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    iDisplayLength: -1,
    drawCallback: function () {
      $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
    },
  });

  $(".select-filter").on("change", function (e) {
    loans_table.draw();
  });

  $(document).on("ajax-screen-submit", function () {
    loans_table.draw();
  });
})(jQuery);
