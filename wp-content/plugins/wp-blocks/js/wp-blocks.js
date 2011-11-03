    // Esnure the $ works with jQuery
    var $ = jQuery.noConflict();

    $(document).ready(function() {   
        
        $('a.wp-block-delete').click(function(){
          var answer = confirm(this.title+' ? Are you sure ?');
          return answer // answer is a boolean
        }); 
        
        $(".wp-code-snippet").focus(function(){
            this.select();
        });
        
    });