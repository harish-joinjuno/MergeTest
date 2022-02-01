@push('header-scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .selection .select2-selection {
            height:calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0;
            font-size: 1.15rem;
            line-height: 1.5;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #fff;
            background-clip: padding-box;
            color:#495057;
        }
        .select2-container.select2-container--default .select2-selection--single .select2-selection__arrow {
            top:8px;
            right:8px;
        }
    </style>
@endpush

@push('footer-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('select').each(function(index, select) {
                if(select.children.length > 0 && select.children[0].value.length === 0) {
                    $(select.children[0]).attr('disabled', 'disabled');
                }
            });

            $('.select-2').select2({
                width: '100%',
            });
        });
    </script>
@endpush
