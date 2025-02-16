<div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
    <div class="rounded shadow py-5 px-4">
        <div class="icon"> <i class="fas fa-user"></i>
        </div>
        <h3 class="mb-3">{{ ucwords($service->title) }}</h3>
        <p class="mb-4">{{ Str::limit($service->short_desc,100) }}
        </p> <a class="btn btn-sm btn-outline-primary" href="{{ route('serviceDetails',$service->id) }}">View
            Details <i class="las la-arrow-right ms-1"></i></a>
    </div>
</div>