jQuery(document).ready(function ($) {          //wrapper
   $(".my_select").on('change', (function (e) {             //event
      const select = $(e.target);
      //use in callback
      $.ajax({
         method: "POST",
         url: my_ajax_obj.ajax_url,
         data: {
            action: "misho_action",
            status: select.val(),
            field: select.data('field')
         }
      });
   }));
});