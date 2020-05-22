$("#image").on("change", function() {
   if ($("#image")[0].files.length > 1) {
      alert("Maksymalnie 20 zdjęć");
   } else if ($("#image")[0].files.length > 0) {
      $("#form").submit();
   }
});