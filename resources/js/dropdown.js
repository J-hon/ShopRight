$(function() {
    $('.dropdown ul li').on('click', function() {
        var label = $(this).parent().parent().children('label');
        label.attr('data-value', $(this).attr('data-value'));
        label.html($(this).html());

        $(this).parent().children('.selected').removeClass('selected');
        $(this).addClass('selected');
    });
});