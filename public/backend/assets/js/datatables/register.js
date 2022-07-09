(function ($) {
    "use strict";
  
    var register_table = $("#register_table").DataTable({
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
        url: _url + "/admin/registers/get_register_table_data",
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
          if ($("select[name=withdraw_method]").val() != "") {
            d.withdraw_method = $("select[name=withdraw_method]").val();
          } 
          if ($("select[name=loan_product]").val() != "") {
            d.loan_product = $("select[name=loan_product]").val();
          } 
        },
        error: function (request, status, error) {
          console.log(request.responseText);
        },
      },
      columns: [
        { data: "created_at", name: "created_at" },
        { data: "loan_id", name: "loan_id" },
        { data: "borrower.name", name: "borrower.name" },
        { data: "cellphone", name: "cellphone" },
        { data: "loan_product", name: "loan_product" },
        { data: "release_date", name: "release_date" },
        { data: "applied_amount", name: "applied_amount" },
        { data: "cash_out", name: "cash_out" },
        { data: "total_payable", name: "total_payable" },
        { data: "total_paid", name: "total_paid" },
        { data: "first_payment_date", name: "first_payment_date" },
        { data: "withdraw_method", name: "withdraw_method" },
        { data: "penalties", name: "penalties" },
        { data: "admin_fee", name: "admin_fee" },
        { data: "description", name: "description" },
        { data: "remarks", name: "remarks" },
        { data: "disbursed_by", name: "disbursed_by" },
        { data: "approved_by", name: "approved_by" },
        { data: "branch", name: "branch" },
        { data: "status", name: "status" },
      ],  
      responsive: false,
      scrollX: true,
      columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 2 },
        { responsivePriority: 3, targets: 5 },
        { responsivePriority: 4, targets: 7 },
        { responsivePriority: 4, targets: 8 },
        { responsivePriority: 4, targets: 9 },
        { responsivePriority: 4, targets: 10 },
        { responsivePriority: 4, targets: 11 },
      ],
      // responsive: {
      //   details: false // This will remove the collapse button
      // },     
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
      register_table.draw();
    });
  
    $(document).on("ajax-screen-submit", function () {
      register_table.draw();
    }); 
  
  })(jQuery);
  