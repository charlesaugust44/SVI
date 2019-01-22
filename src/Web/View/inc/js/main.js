$(document).ready(function () {
    let divs = $("div");
//    $(divs[divs.length - 1]).css({"display": "none"});
});

function toggleInput(id,op)
{
    $input = $("#" + id);
    switch (op)
    {
        case 0:
            $input.slideToggle(100);
            break;
        case 1:
            $input.slideUp(100);
    }
}

function resizePagination()
{
    $p = $(".pagination");
    $w = $(window);
    if($w.width() > 569)
        $p.attr("class", "pagination pagination-lg");
    else
        $p.attr("class", "pagination");
}

$(window).resize(function () {
    resizePagination();
});

resizePagination();