const initBoldCheckout = () => {
    if (document.querySelector('script[src="https://checkout.bold.co/library/boldPaymentButton.js"]')) {
        console.warn('Bold Checkout script is already loaded.');
        return;
    }
    
    var js = document.createElement('script');
    js.onload = () => {
        window.dispatchEvent(new Event('boldCheckoutLoaded'));
    };
    js.onerror = () => {
        window.dispatchEvent(new Event('boldCheckoutLoadFailed'));
    };
    js.src = 'https://checkout.bold.co/library/boldPaymentButton.js';
    document.head.appendChild(js);
};

document.addEventListener('DOMContentLoaded', function() {
    const customButton = document.getElementById('custom-button-payment');
    
    customButton.addEventListener('click', () => {
        initBoldCheckout();
    });

    window.addEventListener('boldCheckoutLoaded', () => {
        const checkout = new BoldCheckout(window.boldCheckoutConfig);
        checkout.open();
    });

    window.addEventListener('boldCheckoutLoadFailed', () => {
        console.error('Failed to load Bold Checkout script');
        alert('Lo sentimos, ha ocurrido un error al cargar el sistema de pagos. Por favor, inténtelo de nuevo más tarde.');
    });
});