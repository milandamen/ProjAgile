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

//deactivate when click on activate class
function deactivate()
{
    $('.activate').click(function (event){

        //save the clicked element to use later on when the class has been changed
        var clickedElement = $(this);
        event.preventDefault();

        $.ajax({
            url: $(this).attr('href')
            ,success: function(response) {

                //unbind this deactivate function
                clickedElement.unbind('click');

                //change the classes
                clickedElement.removeClass(activateClass);
                clickedElement.removeClass('activate');
                clickedElement.addClass(deactivateClass);
                clickedElement.addClass('deactivate');

                //bind to the activate function
                clickedElement.bind('click', activate());
            }
        })

        return false; //block the href
    });
}

//activate when clicked on deactivate class
function activate()
{
    $('.deactivate').click(function (event){
        //save the clicked element to use later on when the class has been changed
        var clickedElement = $(this);
        event.preventDefault();

        $.ajax({
            url: $(this).attr('href')
            ,success: function(response) {

                //unbind this activate function
                clickedElement.unbind('click');

                //change the classes
                clickedElement.removeClass(deactivateClass);
                clickedElement.removeClass('deactivate');
                clickedElement.addClass(activateClass);
                clickedElement.addClass('activate');

                //bind to the deactivate function
                clickedElement.bind('click', deactivate());
            }
        })
        return false; //block the href
    });
}

//when this file loads for the first time, the functions must be called so it will bind to the hrefs
deactivate();
activate();

