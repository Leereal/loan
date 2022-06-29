(function ($) {
  "use strict";

  var user_table = $("#users_table").DataTable({
    processing: true,
    serverSide: true,
    ajax:
      _url + "/admin/users/get_table_data/" + $("#users_table").data("status"),
    columns: [
      // { data: "profile_picture", name: "profile_picture" },
      { data: "file_number", name: "file_number" },
      { data: "name", name: "name" },
      { data: "id_number", name: "id_number" },
      { data: "phone", name: "phone" },
      { data: "employment_detail.name", name: "employment_detail.name" },
      { data: "branch.name", name: "branch.name" },
      { data: "status", name: "status" },      
      { data: "action", name: "action" },
    ],
    responsive: false,
    scrollX: true,
     columnDefs: [
      { responsivePriority: -1, targets: 0},      
      { responsivePriority: 0, targets: 2 },
      { responsivePriority: 1, targets: 1 },
      { responsivePriority: 2, targets: 7 },
      { responsivePriority: 3, targets: 3 },
      { responsivePriority: 4, targets: 5 },
    ],
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

  $(document).on("ajax-screen-submit", function () {
    user_table.draw();
  });
})(jQuery);
