// alert();
// Student Meta data jQuery
// jQuery(document).ready(function ($) {          //wrapper
//    $(".my_select").on('change', (function (e) {             //event
//       const select = $(e.target);
//       //use in callback
//       $.ajax({
//          method: "POST",
//          url: my_ajax_obj.ajax_url,
//          data: {
//             action: "misho_action",
//             status: select.val(),
//             field: select.data('field')
//          }
//       });
//    }));
// });

//alert();
// Student status jQuery
jQuery(document).ready(function ($) {          //wrapper
   $(".student_status_check").on('change', (function (e) {             //event
      const select = $(e.target);
      let active = false;

      // check the checkbox
      if (select.is(":checked")) {
         active = true;
      }

      //use in callback
      $.ajax({
         method: "POST",
         url: my_ajax_obj.ajax_url,
         data: {
            action: "save_ajax_status",
            'active': active,
            'student-id': select.data("student-id"),
         }
      });
   }));
});
