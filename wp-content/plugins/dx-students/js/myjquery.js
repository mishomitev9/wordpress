jQuery(document).ready(function ($) {          //wrapper
   $("#select").on('change', (function () {             //event
      var show_hide_status = $("#select").val();                     //use in callback
      console.log(show_hide_status);
      $.ajax({
         method: "POST",
         url: my_ajax_obj.ajax_url,
         data: {
            action: "",
            value: ""
         }
      }).success((data) => {

      });
   }));
});