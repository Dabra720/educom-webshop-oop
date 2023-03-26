
// src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"

// src="https://code.jquery.com/jquery-3.6.4.js" 
// integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" 
// crossorigin="anonymous">

$(document).ready( function() {

  $(".rating").each( function(i, obj){

    const productid = $(obj).attr('data-id');
    $.ajax({
      // url: "https://api.dev-master.ninja/js/rating",
      url: "index.php?action=ajax&function=getRating&id="+productid,
      method: "POST",
      data: {},
      success: function(result) { 
        // Your code goes here!
        // console.log("Rating: " + result.rating)
        // console.log("Product Id: " + productid)


              /// Paint it Red!
        $(".star").each( (index, elem) => {
          const itemId = $(elem).attr("id")
          if(itemId==productid){
            const itemValue = $(elem).attr("data-index")
            if(itemValue <= result.rating) {
              $(elem).addClass("red")
            }
          }
          
        })

      }
    })
    // }
    
  })

  $(".star").click( function() {
    
    const value = $(this).attr('data-index')
    const productid = $(this).attr('id')
    // console.log("KLIK! " + productid)
    $(".star").each( (index, elem) => {
      const itemId = $(elem).attr("id")
      if(itemId==productid){
        $(elem).removeClass("red")
      }
      
    })

    $.ajax({
      // url: "https://api.dev-master.ninja/js/rating",
      url: "index.php?action=ajax&function=setRating&id="+productid,
      method: "POST",
      data: { rating: value },
      success: function(result) { 
        // Your code goes here!
        // console.log("Rating2: " + result.rating)
        // console.log("Product Id2: " + productid)

              /// Paint it Red!
        $(".star").each( (index, elem) => {
          const itemId = $(elem).attr("id")
          if(itemId==productid){
            const itemValue = $(elem).attr("data-index")
            if(itemValue <= result.rating) {
              $(elem).addClass("red")
            }
          }
          
        })

      }
    })


  })

});
  
