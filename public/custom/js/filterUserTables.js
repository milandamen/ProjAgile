var rows = $('tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

$('.activate').click(function (event){
    
    event.preventDefault();
    //$.ajax({
    //    url: $(this).attr('href')
    //    ,success: function(response) {
    //        alert(response)
    //    }
    //})
    return false; //for good measure
});

$('.deactivate').click(function (event){

    event.preventDefault();
    //$.ajax({
    //    url: $(this).attr('href')
    //    ,success: function(response) {
    //        alert(response)
    //    }
    //})
    return false; //for good measure
});