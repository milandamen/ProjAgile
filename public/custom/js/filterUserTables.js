var deactivateClass = "black";
var activateClass = "text-success";

var rows = $('tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

$('.activate').click(function (event){

    var clickedElement = $(this);

    event.preventDefault();

    $.ajax({
        url: $(this).attr('href')
        ,success: function(response) {
            clickedElement.removeClass(activateClass);
            clickedElement.addClass(deactivateClass);
        }
    })

    return false; //for good measure
});

$('.deactivate').click(function (event){

    var clickedElement = $(this);

    event.preventDefault();

    $.ajax({
        url: $(this).attr('href')
        ,success: function(response) {
            clickedElement.removeClass(deactivateClass);
            clickedElement.addClass(activateClass);
        }
    })
    return false; //for good measure
});