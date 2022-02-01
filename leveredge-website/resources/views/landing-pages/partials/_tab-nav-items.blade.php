@push('header-scripts')
    <style>
        .tab-nav-item {
            min-width:125px;
            width:125px;
            max-width:125px;
            cursor:pointer;
        }
        .tab-nav-item:focus {
            outline:1px dashed;
        }
        .tab-nav-item.selected {
            font-weight:700;
        }
        .selected-item-underline {
            height:3px;
            width:125px;
            background:#B3DAD9;
            display:inline-block;
            position:absolute;
            bottom:0;
            left:1rem;
            transition:transform .2s ease-in-out;
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabNavItems = document.querySelectorAll('.tab-nav-item');
            const tabContentItems = document.querySelectorAll('.tab-content-item');
            const tabUnderline = document.querySelector('.selected-item-underline');

            document.addEventListener('click', function(event) {
                toggleTab(event);
            });

            document.addEventListener('keydown', function(event) {
                if(event.code === 'Space') {
                    toggleTab(event);
                }
            });

            function toggleTab(event) {
                const element = event.target;
                if(element && element.matches('.tab-nav-item')) {
                    event.preventDefault();
                    const tabToOpen = document.querySelector(element.dataset['openTab']);

                    tabNavItems.forEach(tab => {
                        tab.classList.remove('selected');
                        tab.setAttribute('aria-selected', 'false');
                    });
                    tabContentItems.forEach(contentTab => {
                        contentTab.classList.add('d-none');
                        contentTab.setAttribute('aria-hidden', 'true');
                    });

                    element.classList.add('selected');
                    element.setAttribute('aria-selected', 'true');
                    tabToOpen.classList.remove('d-none');
                    tabToOpen.setAttribute('aria-hidden', 'false');

                    const currentIndex = element.dataset['tabIndex'];
                    const offset = (currentIndex * 125);
                    tabUnderline.style.transform = 'translateX(' + offset + 'px)';
                    element.parentElement.scrollTo({
                        top: 0,
                        left: (offset / 2),
                        behavior: 'smooth',
                    });
                }
            }
        });
    </script>
@endpush

<div class="container-fluid bg-white border-top border-bottom px-0">
    <div class="container">
        <div class="row flex-nowrap overflow-auto position-relative tab-nav-row px-3">
            @foreach($tabs as $index => $tab)
                <div
                    id="navTab{{ $index }}"
                    role="tab"
                    aria-controls="{{ $tab['element'] }}"
                    aria-selected="{{ !empty($tab['selected']) }}"
                    data-open-tab="{{ $tab['element'] }}"
                    data-tab-index="{{ $index }}"
                    tabindex="0"
                    class="tab-nav-item flex flex-column py-3 align-items-center justify-content-center text-center
                    {{ !empty($tab['selected']) ? 'selected' : '' }}"
                >
                    {{ $tab['title'] }}
                </div>
            @endforeach
            <span class="selected-item-underline"></span>
        </div>
    </div>
</div>
