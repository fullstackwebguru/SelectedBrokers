

$(document).ready(function() {

    $('#category-readmore').click(function() {
        $(this).hide(500).remove();
        $('#category-subheading').show(500);
    });

    new jBox('Tooltip', {
      attach: '.tooltip'
    });
});

$(document).ready(function() {
    new jBox('Tooltip', {
      attach: '.tooltip2'
    });
});
