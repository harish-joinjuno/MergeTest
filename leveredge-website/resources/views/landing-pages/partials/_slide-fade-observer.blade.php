<script>
    if(typeof(IntersectionObserver) != 'undefined') {
        const intersectionOptions = {
            rootMargin: '200px',
            threshold: 0.5,
        }
        const intersectionObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, intersectionOptions);

        const slideFadeIn = document.querySelectorAll('.slide-fade-in');
        slideFadeIn.forEach((element) => {
            intersectionObserver.observe(element);
        });
    }
</script>
