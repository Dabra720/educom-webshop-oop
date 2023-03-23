<?php 
showSite();

function showSite(){
  echo '
<!DOCTYPE html>
<html lang="en">
  <head>
  ';
  showCSSLinks();
  echo '<script src="../js/jquery.js"></script>
  <script src="../rating.js"></script>
  </head>';
  showBody();


echo '</html>';
}

function showBody(){
//   echo '
// <!DOCTYPE html>
// <html lang="en">
//   <head> 
//     <link rel="stylesheet" href="../css/style.css"/>
//     <!--<script src="js/jquery.js"></script>-->
//     <script 
//       src="https://code.jquery.com/jquery-3.6.4.js" 
//       integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" 
//       crossorigin="anonymous">
//     </script>
//     <script>
//       $(document).ready( function() {

//         $(".star").click( function() {
//           const value = $(this).attr(\'data-value\')

//           $(".star").removeClass("red");

//           /// Paint it Red!
//           $(".star").each( (index, elem) => {
//               const itemValue = $(elem).attr("data-value")
//               if(itemValue <= value) {
//                 $(elem).addClass("red")
//               }
//             })
//             ///

//             $.ajax({
//               url: "../view/ajax_doc.php",
//               method: "POST",
//               data: { rating: value },
//               success: function(result) { 
//                 // Your code goes here!
//                 console.log(result)
//                 console.log("Result: " + result.result)
//                 console.log("Rating: " + result.rating)
//               }
//             })
//         })
//       })
      
//     </script>
//   </head>';
  echo '<body>
     
     <span class="star" data-value="1">*</span>
     <span class="star" data-value="2">*</span>
     <span class="star" data-value="3">*</span>
     <span class="star" data-value="4">*</span>
     <span class="star" data-value="5">*</span>

  </body>
</html>
';
}

function showCSSLinks(){
  echo '<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">';
  echo '<!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>';
  echo '<!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>';
  echo '<!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>';
  echo '<link rel="stylesheet" href="../css/style.css">';
}



?>