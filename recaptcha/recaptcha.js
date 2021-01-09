grecaptcha.ready(function() {
    grecaptcha.execute('6LftJsQUAAAAAGQE3r3zcs75Z8x7qqieSg0Mi3If', { action: 'ecommerce' }).then(function(token) {
        document.getElementById('g-recaptcha-response').value = token;
    });
});