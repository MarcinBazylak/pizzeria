$(function() {

   $("#add-item").on("submit", function(e) {

      e.preventDefault();

      id = $("#id").val();

      $.ajax({
         type: "post",
         url: "addItem.php",
         data: {
            id: $("#id").val(),
            number: $("#number").val(),
         },
         success: function(data) {            
            showAlert(data);
         }
      });
      document.getElementById("submit").disabled = true;

   });

});

function showAlert(alert) {
   if(alert != "") {
      document.getElementById("addItemSpn").innerText = alert;
   }
}