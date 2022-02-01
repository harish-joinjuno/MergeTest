@push('footer-scripts')
    <script>
        $(document).ready(function() {
            const dynamicDegree = $('#dynamicDegree');
            const educationLevelSelect = $('#educationLevel select');
            educationLevelSelect.change(function(event) {
                const value = $(this).val();

                if (value != null) {
                    const selectOptions = getSelectOptions(value);
                    setSelectOptions(selectOptions);
                    dynamicDegree.removeClass('d-none');
                } else {
                    dynamicDegree.addClass('d-none');
                }
            });
            educationLevelSelect.trigger('change');

            function getSelectOptions(value) {
                const undergradLevels = ['High School', 'Undergraduate Student', 'Parent'];
                const gradLevels = ['Graduate Student'];
                if (undergradLevels.includes(value)) {
                    return JSON.parse($('#undergradSelectOptions').val());
                }

                if(gradLevels.includes(value)) {
                    return JSON.parse($('#gradSelectOptions').val());
                }

                return [];
            }

            function setSelectOptions(options) {
                const selectElement = dynamicDegree.find('select');
                selectElement.children().each(function(index, child) {
                    if(index > 0) {
                        child.remove();
                    }
                });
                if(options.length) {
                    options.forEach(function(item){
                        const option = new Option(item.name, item.name);
                        selectElement.append(option);
                    });
                    selectElement.removeAttr('disabled');
                } else {
                    selectElement.attr('disabled', 'disabled');
                }
            }
        });
    </script>
@endpush

@php /** @var \App\ScholarshipQuestion $scholarshipQuestion **/ @endphp
<div id="dynamicDegree" class="form-group col-12 d-none">
    <label for="degree_select_{{ $scholarshipQuestion->id }}">{{ $scholarshipQuestion->label }}</label>
    <select
        class="form-control select-2"
        id="degree_select_{{ $scholarshipQuestion->id }}"
        name="{{ $scholarshipQuestion->field_name }}"
    >
        <option value="">Select your degree</option>
        @foreach(\App\Degree::whereType('undergraduate')->orderBy('name')->get() as $degree)
            <option>{{ $degree->name }}</option>
        @endforeach
    </select>
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

    <input
        id="undergradSelectOptions"
        type="hidden"
        value="{{ \App\Degree::whereType('undergraduate')->orderBy('name','asc')->get() }}"
    >
    <input
        id="gradSelectOptions"
        type="hidden"
        value="{{ \App\Degree::whereType('graduate')->orderBy('name','asc')->get() }}"
    >
</div>
