<?php ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="../css/style.css"/>
    <!--<script src="js/jquery.js"></script>-->
    <script 
      src="https://code.jquery.com/jquery-3.6.4.js" 
      integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" 
      crossorigin="anonymous">
    </script>
    <script>
      
    </script>
    <script>
      $(document).ready( function() {

        $(".star").click( function() {
          const value = $(this).attr('data-value')

          $(".star").removeClass("red");

          /// Paint it Red!
          $('.star').each( (index, elem) => {
              const itemValue = $(elem).attr('data-value')
              if(itemValue <= value) {
                $(elem).addClass('red')
              }
            })
            ///

            $.ajax({
              url: "https://api.dev-master.ninja/js/rating",
              method: "POST",
              data: { rating: value },
              success: function(result) { 
                // Your code goes here!
                alert("Succes! Result: " + result.result)
                console.log("Succes! Result: " + result.rating)
              }
            })
        })
        

      })

      
    </script>
  </head>
  <body>
     
     <span class="star" data-value="1">*</span>
     <span class="star" data-value="2">*</span>
     <span class="star" data-value="3">*</span>
     <span class="star" data-value="4">*</span>
     <span class="star" data-value="5">*</span>

  </body>
</html>

