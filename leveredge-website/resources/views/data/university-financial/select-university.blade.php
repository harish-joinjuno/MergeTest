<div class="container">
    <div class="row">
        <div class="col-12">

            <h2>See what could happen at your school or alma mater</h2>
            <div class="separator"></div>

            <div class="mt--3">

                <form id="navigate_to_university_page" method="get" action="">
                    <div class="form-group">
                        <h4><label for="university">Select your University</label></h4>
                        <select name="university" class="form-control" id="university" onChange="changeAction()">
                            <option>Select a University</option>
                            @foreach($universities as $university_data)
                                <option value="{{ url('/college-costs/' . $university_data->slug)  }}">{{ $university_data->university_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Check it Out</button>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    function changeAction(){
        var form = document.getElementById("navigate_to_university_page");
        var university_dropdown = document.getElementById("university");
        var selected_action = university_dropdown.options[university_dropdown.selectedIndex].value
        // console.log(selected_action);
        form.action = selected_action;
    }
</script>
