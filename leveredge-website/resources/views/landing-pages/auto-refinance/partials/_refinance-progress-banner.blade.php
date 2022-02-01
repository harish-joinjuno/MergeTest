<div class="row py-3">
    <div class="col-12 col-sm-6 text-center py-3">
        <h2 class="off-black">
            {{ $completedApplications ?? '0' }}
            <small>out of {{ $totalApplications ?? '0' }}</small>
        </h2>
        <div
            class="col-8 col-sm-10 offset-2 offset-sm-1 rounded-pill px-0"
            style="background:#F0F0F4;"
        >
            <div
                class="h-100 rounded-pill bg-secondary-green py-1"
                style="width:{{  $currentProgress > 100 ? 100 : $currentProgress }}%;"
            ></div>
        </div>
        <div class="col-8 col-sm-10 offset-2 offset-sm-1 px-0 mt-1">
            <p
                class="text-left text-muted"
                style="font-size:10px;">
                0 <span class="float-right text-right">{{ $totalApplications ?? '0' }} people</span>
            </p>
        </div>
    </div>
    <div class="col-12 col-sm-6 text-center py-3">
        <h2 class="off-black mb-0">
            ${{ $refinanceAmount }}
        </h2>
        <p class="small mb-0">to be refinanced</p>
    </div>
</div>
