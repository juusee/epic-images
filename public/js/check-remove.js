$(".form-remove").submit(function( event ) {
    if (confirm("Are you sure?"))
        return;
    event.preventDefault();
});