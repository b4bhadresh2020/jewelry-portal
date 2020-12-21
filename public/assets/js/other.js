// start savan ::
function img_pathUrl(input,img){
    $(img)[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

// common delete confirmation code
$(document).on("click",'.common-remove-popup',function(){
    let item = $(this);
    $.confirm({
        title: item.attr('data-title'),
        content: item.attr('data-content'),
        boxWidth: '30%',
        useBootstrap: false,
        buttons: {
            Yes: function(){
                let formUrl = item.attr('data-url');
                let formCsrf = item.attr('data-csrf');
                $("body").append('<form id="formDeleteAny" action="'+formUrl+'" method="POST">' +
                    '<input type="hidden" name="_method" value="DELETE">' +
                    '<input type="hidden" name="_token" value="'+formCsrf+'"></form>');
                $("#formDeleteAny").submit();
            },
            No: function(){ }
        }
    });
});

$(document).on("click",'.common-normal-link-confirmation',function(){
    let item = $(this);
    $.confirm({
        title: item.attr('data-title'),
        content: item.attr('data-content'),
        boxWidth: '30%',
        useBootstrap: false,
        buttons: {
            Yes: function(){
                window.location.href = item.attr('data-url');
            },
            No: function(){}
        }
    });
});
// end savan ::
