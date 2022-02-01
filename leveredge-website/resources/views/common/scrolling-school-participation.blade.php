<div id="schools_wrapper">

    <div id="fixed-participation-sign" class="pt-2 pb-2 bg-white pr-3 pl-2">
        Students Participating
    </div>

    <div id="schools_move">
        <div class="mt-2 mb-2">
            @php
                $data = [
                "Harvard"	=>	230	,
                "Booth"	=>	249	,
                "Wharton"	=>	216	,
                "Kellogg"	=>	129	,
                "Ross"	=>	138	,
                "Columbia"	=>	128	,
                "Berkeley"	=>	116	,
                "Fuqua"	=>	105	,
                "Stanford"	=>	91	,
                "Tuck"	=>	101	,
                "Anderson"	=>	77	,
                "Sloan"	=>	82	,
                "Darden"	=>	66	,
                "NYU"	=>	33	,
                "Cornell"	=>	36	,
                "Yale"	=>	27
                ];

            $counter = 0;
            @endphp

            @while(true)

                @foreach($data as $school => $count)
                    <div class="d-inline-block ml-3 mr-3">
                        <p>{{ $school }}: {{ $count }}</p>
                    </div>

                    <div class="d-inline-block">
                        <i style="font-size: 8px; color: rgba(0,0,255,0.2);" class="fas fa-circle align-middle"></i>
                    </div>
                @endforeach

                @php
                    $counter ++;
                @endphp

                @if($counter == 10)
                    @break
                @endif

            @endwhile


        </div>
    </div>
</div>


@push('footer-scripts')

    <script>

        $(document).ready(function(){
            setTimeout(reslide(), 4000);
        });

        function reslide(){
            $('#schools_move').queue(function(){
                $(this).css({left:"0px"}).dequeue();
            }).animate({left:"-1000px"}, 20000, "linear" , reslide);
        }
    </script>

@endpush
