import Vue from 'vue';

Vue.directive('money', {

    bind(el) {
        el.setAttribute('maxlength', '18');
        const input = el;

        const mask = () => {
            let v = input.value;
            v = v.toString().replace(/[^0-9]/g, '');
            v = v.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            input.value = v;
            el.dispatchEvent(new Event('input', {bubbles: true}));
        };

        input.addEventListener('change', () => {
            setTimeout(mask, 1);
        });

        input.addEventListener('keydown', () => {
            el.dispatchEvent(new Event('change', {bubbles: true}));
        });

        mask();
    },
});
