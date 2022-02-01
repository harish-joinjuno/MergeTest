@php /** @var \App\ScholarshipQuestion $scholarshipQuestion **/ @endphp
<div class="form-group col-12">
    <label for="long_text_{{ $scholarshipQuestion->id }}">{{ $scholarshipQuestion->label }}</label>
    <textarea class="form-control" id="long_text_{{ $scholarshipQuestion->id }}" rows="5" name="{{ $scholarshipQuestion->field_name }}"></textarea>
    @if($scholarshipQuestion->helper_text)
        <p class="small px-sm-3 mt-1 mb-0 text-muted">
            {{ $scholarshipQuestion->helper_text }}
        </p>
    @endif
    @error($scholarshipQuestion->field_name)
    <div class="text-danger" role="alert">
        <small>{{ $errors->first($scholarshipQuestion->field_name) }}</small>
    </div>
    @enderror
</div>

@push('header-scripts')
    <script src="https://cdn.tiny.cloud/1/hngg8nkexvgylep4uv94vpeml04ecueq83utiy91l6tz8o8l/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            menubar: false,
            statusbar: false,
            toolbar: 'undo redo | bold italic',
            oninit : "setPlainText",
            plugins : "paste"
        });

        function setPlainText() {
            var ed = tinyMCE.get('elm1');

            ed.pasteAsPlainText = true;

            //adding handlers crossbrowser
            if (tinymce.isOpera || /Firefox\/2/.test(navigator.userAgent)) {
                ed.onKeyDown.add(function (ed, e) {
                    if (((tinymce.isMac ? e.metaKey : e.ctrlKey) && e.keyCode == 86) || (e.shiftKey && e.keyCode == 45))
                        ed.pasteAsPlainText = true;
                });
            } else {
                ed.onPaste.addToTop(function (ed, e) {
                    ed.pasteAsPlainText = true;
                });
            }
        }
    </script>
@endpush
