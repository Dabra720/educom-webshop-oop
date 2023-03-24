
// src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"

// src="https://code.jquery.com/jquery-3.6.4.js" 
// integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" 
// crossorigin="anonymous">

$(document).ready( function() {

  // $(".rating").each( function(i, obj){

  // });

  $(".rating").each( (index, elem) => {
    // console.log('Rating element:');
    const productid = $(elem).attr('data-id');
    // function(){
      $.ajax({
        // url: "https://api.dev-master.ninja/js/rating",
        url: "index.php?action=ajax&function=setRating&id="+productid,
        method: "POST",
        data: { product_id: productid },
        success: function(result) { 
          // Your code goes here!
          console.log("Result: " + result.result)
          // console.log("ID: " + result.id)
          console.log("Rating: " + result.rating)
          console.log("Product Id: " + productid)


                /// Paint it Red!
          $(".star").each( (index, elem) => {
            const itemId = $(elem).attr("id")
            if(itemId==productid){
              const itemValue = $(elem).attr("data-index")
              if(itemValue <= result.result) {
                $(elem).addClass("red")
              }
            }
            
          })

        }
      })
    // }
    
  })

});
    // $(".star").click( function() {
    //   const index = $(this).attr('data-index')
  
    //   $(".star").removeClass("red");
  
    //   /// Paint it Red!
    //   $(".star").each( (index, elem) => {
    //       const itemValue = $(elem).attr("data-value")
    //       if(itemValue <= value) {
    //         $(elem).addClass("red")
    //       }
    //     })
    //     ///

    // $.ajax({
    // url: "index.php?action=ajax&function=getRating",
    // method: "POST",
    // data: {},
    // success: function(result){

    // }

  // })
  
