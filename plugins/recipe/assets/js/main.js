// (function($){
//     $("#recipe_rating").bind( 'rated', function(){
//         $(this).rateit( 'readonly', true );

//         var form        =   {
//             action:         'r_rate_recipe',
//             rid:            $(this).data( 'rid' ),
//             rating:         $(this).rateit( 'value' )
//         };

//         $.post( recipe_obj.ajax_url, form, function(data){
            
//         });
//     });
// })(jQuery);

(function($){
    $("#recipe_rating").on('rated', function(){
        // alert('Touched something here');
        $(this).rateit( 'readonly', true );
        let form = {
            action: 'r_rate_recipe',
            rid: $(this).data( 'rid' ),
            rating: $(this).rateit( 'value' )
        }
        // console.log(form);
        $.post(recipe_obj.ajax_url, form, function (data){
            // console.log(data.response);
        });
        // $.ajax({
        //     beforeSend: (xhr) => {
        //         xhr.setRequestHeader('X-WP-Nonce', recipe_obj.nonce)
        //     },
        //     type: 'POST',
        //     data: form,
        //     url: recipe_obj.ajax_url,
        //     success: (response) => {
        //         console.log(response);
        //     },
        //     error: (response) => {
        //         console.log(response);
        //     },
        // })
    });
})(jQuery);