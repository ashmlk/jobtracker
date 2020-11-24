$(document).ready(function () {
    $('.list-group-item').on("click", function() {
        window.location = $(this).find("a").attr("href");
        });
        var CurrentUrl= document.URL;
        var CurrentUrlEnd = CurrentUrl.split('/').filter(Boolean).pop();
        $( ".list-group-item a" ).each(function() {
              var ThisUrl = $(this).attr('href');
              var ThisUrlEnd = ThisUrl.split('/').filter(Boolean).pop();

              if(ThisUrlEnd == CurrentUrlEnd){
              $(this).closest('li').addClass('active')
              }
        });
})