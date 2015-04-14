$(function() {
    $(".footerAutocomplete").autocomplete({
        source: "/footer/autocomplete",
        minLength: 2
    });
});