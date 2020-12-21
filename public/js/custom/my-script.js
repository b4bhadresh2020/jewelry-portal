// common delete confirmation code
$(document).on("click", '.common-remove-popup', function () {
    let item = $(this);
    $.confirm({
        title: item.attr('data-title'),
        content: item.attr('data-content'),
        boxWidth: '30%',
        useBootstrap: false,
        buttons: {
            Yes: function () {
                let formUrl = item.attr('data-url');
                let formCsrf = item.attr('data-csrf');
                $("body").append('<form id="formDeleteAny" action="' + formUrl + '" method="POST">' +
                    '<input type="hidden" name="_method" value="DELETE">' +
                    '<input type="hidden" name="_token" value="' + formCsrf + '"></form>');
                $("#formDeleteAny").submit();
            },
            No: function () { }
        }
    });
});

$(document).on("click", '.common-normal-link-confirmation', function () {
    let item = $(this);
    $.confirm({
        title: item.attr('data-title'),
        content: item.attr('data-content'),
        boxWidth: '30%',
        useBootstrap: false,
        buttons: {
            Yes: function () {
                window.location.href = item.attr('data-url');
            },
            No: function () { }
        }
    });
});

// change table items

var getParams = function (url) {
    var params = {};
    var parser = document.createElement('a');
    parser.href = url;
    var query = parser.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        params[pair[0]] = decodeURIComponent(pair[1]);
    }
    return params;
};

function trim(s, mask) {
    while (~mask.indexOf(s[0])) {
        s = s.slice(1);
    }
    while (~mask.indexOf(s[s.length - 1])) {
        s = s.slice(0, -1);
    }
    return s;
}

function copyClipbord(data) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(data).select();
    document.execCommand("copy");
    $temp.remove();
}

function img_pathUrl(input, img) {
    $(img)[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}

// change pagination items - global page - on page loader level
$(document).on('change', ".change-paginate-items", function () {
    let location = window.location;
    var newItems = $(this).val();
    __qs_change('items', newItems)
    var qs = getParams(window.location.href);
    var newQr = "";
    $.each(qs, function ($key, $value) {
        if ($key == "items") {
            qs['items'] = newItems;
        }
        if ($key == "page") {
            qs['page'] = 1;
        }
        newQr += $key + "=" + qs[$key] + "&";
    });
    location.href = (trim(location.origin + location.pathname + "?" + newQr, "&"))
});


// Pre-loader
document.addEventListener("DOMContentLoaded", function () {
    let timeOut = 0;
    $('.preloader-background').delay(timeOut).fadeOut();
    $('.preloader-wrapper').delay(timeOut).fadeOut();
});

$(document).on("click", ".table-tabs-pills .nav-item", function () {
    $(this).parents(".table-tabs-pills").find(".nav-link.active").removeClass("active");
    $(this).find(".nav-link").addClass("active");
});

//Checkbox In Table Select All
$(document).on('change', '.check-all', function (event) {
    event.preventDefault();
    if ($(this).prop("checked") == true) {
        $(this).parents("table").find("tbody tr").each(function (index, el) {
            $(el).find('td .checkable').prop('checked', true);
            $(el).addClass('active-tr-checkable');
        });
    } else {
        $(this).parents("table").find("tbody tr").each(function (index, el) {
            $(el).find('td .checkable').prop('checked', false);
            $(el).removeClass('active-tr-checkable');
        });
    }
});


$(document).on('change', '.checkable', function (event) {
    event.preventDefault();
    if ($(this).prop("checked") == true) {
        $(this).parent("td").parent("tr").addClass('active-tr-checkable');
    } else {
        $(this).parent("td").parent("tr").removeClass('active-tr-checkable');
    }
});


