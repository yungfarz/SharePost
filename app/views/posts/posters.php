<?php require_once APPROOT . '/views/inc/header.php';?>

     <a href="<?php echo URLROOT; ?>posts" class="btn btn-light"><i class="fa fa-backward"></i>Back</a>

      


     <div class="col-sm-12">
 
            <div class='table-responsive' id='showPosters'>



            </div>
           


     </div>










 <script  type="text/javascript" >
  
     $(document).ready(function(){
   

 
       showPosters();
 
       // Display Leads
         function showPosters() { 

       
                   
       
            // sending using ajax
            $.ajax({
                
                type:'POST',
                cache:false,
                data:{action:"view"},
                
                success:function(response){
                   
                    
                    $('#showPosters').html(response);
                
                },
                error:function(error){
                  alert(error);
                }
            });

        

        }

        
           //insert ajax request
            



        
        
   

});


    </script>
<?php require_once APPROOT . '/views/inc/footer.php';?>

