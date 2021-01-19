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
    $("#recipe_rating").bind('rated', function(){
        // alert('Touched something here');
        $(this).rateit( 'readonly', true );
        var form = {
            action: 'r_rate_recipe',
            rid: $(this).data( 'rid' ),
            rating: $(this).rateit( 'value' )
        }
        //  console.log(recipe_obj.ajax_url);
        $.post(recipe_obj.ajax_url, form, function (data){
            console.log(data);
        });
        
    });
})(jQuery);