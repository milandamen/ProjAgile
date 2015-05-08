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

//CHANGE HREF AND ICON CLASS

$('.activate').click(function (event){

    var clickedElement = $(this);

    event.preventDefault();

    $.ajax({
        url: $(this).attr('href')
        ,success: function(response) {
            console.log('succ 1');
            clickedElement.removeClass(activateClass);
            clickedElement.removeClass('activate');
            clickedElement.addClass(deactivateClass);
            clickedElement.addClass('deactivate');

            $('.deactivate').click(function (event){

                var clickedElement = $(this);

                event.preventDefault();

                $.ajax({
                    url: $(this).attr('href')
                    ,success: function(response) {
                        console.log('succ 2');
                        clickedElement.removeClass(deactivateClass);
                        clickedElement.removeClass('deactivate');
                        clickedElement.addClass(activateClass);
                        clickedElement.addClass('activate');


                    }
                })
                return false; //for good measure
            });
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
            console.log('succ 2');
            clickedElement.removeClass(deactivateClass);
            clickedElement.removeClass('deactivate');
            clickedElement.addClass(activateClass);
            clickedElement.addClass('activate');

            $('.activate').click(function (event){

                var clickedElement = $(this);

                event.preventDefault();

                $.ajax({
                    url: $(this).attr('href')
                    ,success: function(response) {
                        console.log('succ 1');
                        clickedElement.removeClass(activateClass);
                        clickedElement.removeClass('activate');
                        clickedElement.addClass(deactivateClass);
                        clickedElement.addClass('deactivate');
                    }
                })

                return false; //for good measure
            });
        }
    })
    return false; //for good measure
});

