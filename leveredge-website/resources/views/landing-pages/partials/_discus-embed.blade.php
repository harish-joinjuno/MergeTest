@push('footer-scripts')
    <script>
        var disqus_config = function () {
            this.page.url = '{{ request()->url() }}';
            this.page.identifier = '{{ request()->path() }}';
        };

        (function() {
            var d = document, s = d.createElement('script');
            s.src = 'https://joinjuno.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
@endpush

<div class="container-fluid bg-light py-5">
    <div class="container narrow">
        <div id="disqus_thread"></div>
    </div>
</div>

<noscript>
    Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
</noscript>
