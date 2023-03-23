
// src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"

// src="https://code.jquery.com/jquery-3.6.4.js" 
// integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" 
// crossorigin="anonymous">

$(document).ready( function() {

  $(".star").click( function() {
    const value = $(this).attr('data-value')

    $(".star").removeClass("red");

    /// Paint it Red!
    $(".star").each( (index, elem) => {
        const itemValue = $(elem).attr("data-value")
        if(itemValue <= value) {
          $(elem).addClass("red")
        }
      })
      ///

      $.ajax({
        // url: "https://api.dev-master.ninja/js/rating",
        url: "../views/ajax_doc.php",
        method: "POST",
        data: { rating: value },
        success: function(result) { 
          // Your code goes here!
          console.log(result)
          console.log("Result: " + result.result)
          console.log("Rating: " + result.rating)
        }
      })
  })
})