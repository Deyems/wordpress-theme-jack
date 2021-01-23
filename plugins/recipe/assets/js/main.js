(function($){
    //Handle Recipe ratings
    $("#recipe_rating").bind('rated', function(){
        $(this).rateit( 'readonly', true );
        var form = {
            action: 'r_rate_recipe',
            rid: $(this).data( 'rid' ),
            rating: $(this).rateit( 'value' )
        }
        $.post(recipe_obj.ajax_url, form, function (data){
            
        });
        
    });    
    //Handling Form Submission from Front-end
    $("#recipe-form").on( 'submit', function(e){
        e.preventDefault();
        //Hide the form during Submission
        $(this).hide();
        //
        $("#recipe-status").html(`
            <div class="alert alert-info">Please wait while we are submitting your recipe</div>
        `);

        let form = {
            action: 'r_submit_user_recipe',
            title: $("#r_inputTitle").val(),
            content: tinymce.activeEditor.getContent()
        }
        // console.log(form);
        $.post(recipe_obj.ajax_url, form, function(data){
            console.log(data);
            if(data.status == 2){
                $("#recipe-status").html(`
                    <div class="alert alert-success">Recipe submitted successfully!</div>
                `);
            }else{
                $("#recipe-status").html(`
                    <div class="alert alert-danger">Unable to submit recipe. Please fill in all fields </div>
                `);
                $("#recipe-form").show()
            }
        });
    });
})(jQuery);