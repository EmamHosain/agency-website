<div class="col-lg-4 col-md-6 service-item">
    <a class="text-black" href="{{ route('serviceDetails',$service->id) }}">
        <div class="block"> <span class="colored-box text-center h3 mb-4">{{ $n <= 9 ? '0' . $n : $n }}</span>
                    <h3 class="mb-3 service-title">{{ ucfirst($service->title) }}</h3>
                    <p class="mb-0 service-description">{{ Str::limit($service->short_desc,50) }}</p>
        </div>
    </a>
</div>