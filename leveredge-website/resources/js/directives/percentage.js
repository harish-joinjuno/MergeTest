import Vue from 'vue';

Vue.directive('percentage', {

    bind(el) {
        el.setAttribute('maxlength', '6');
        const input = el;

        const mask = () => {
            let v = input.value;
            v = v.toString().replace(/[^0-9]/g, '');

            v = v.replace(/^0*/g, '');
            v = v.replace(/^$/, '0.00');
            v = v.replace(/^(\d)$/, '0.0$1');
            v = v.replace(/^(\d{2})$/, '0.$1');
            v = v.replace(/(\d+)(\d{2})$/, '$1.$2');
            v = v.replace(/\d(?=(\d{3})+\.)/g, '$&,');

            input.value = v !== '0.00' ? v : '';
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
