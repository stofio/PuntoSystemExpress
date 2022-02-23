 //allow only numbers input
 $(document).on('input', 'input.only-numb', (e) => {
   $(e.target).val($(e.target).val().replace(/[^\d]/, ''));
 });


 //save USER commissions in db
 $(document).on('submit', '.user_comm_form', (e) => {
   e.preventDefault();

   var formData = new FormData(e.currentTarget);

   $(e.target).find('button').html('Save...');

   $.ajax({
     url: "include/commissions/save_user_commission.php",
     type: "POST",
     processData: false,
     contentType: false,
     data: formData,
     cache: false,
     success: function(dataResult) {
       console.log(dataResult)

       $(e.target).find('button').html('Saved ✓');
       setTimeout(function() {
         $(e.target).find('button').html('Save');
       }, 1500);

     }
   });
 });


 //save DEFAULT commissions in json
 $(document).on('submit', '.def_comm_form', (e) => {
   e.preventDefault();

   var formData = new FormData(e.currentTarget);

   $(e.target).find('button').html('Save...');

   //save json
   $.ajax({
     url: "include/commissions/save_default_commission.php",
     type: "POST",
     processData: false,
     contentType: false,
     data: formData,
     cache: false,
     success: function(dataResult) {
       console.log(dataResult)

       $(e.target).find('button').html('Saved ✓');
       setTimeout(function() {
         $(e.target).find('button').html('Save');
       }, 1500);

     }
   });

 });