$('.add-to-cart').click(function (e) {
    e.preventDefault();
    let path  = $(this).attr('href');
    $('#notification-message').load(path);
    // $('.cart').load(cartPath);
});