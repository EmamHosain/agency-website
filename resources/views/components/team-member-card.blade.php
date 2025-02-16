<div class="col-xl-3 col-lg-4 col-md-6 mt-4">
    <div class="card bg-transparent border-0 text-center">
        <div class="card-img">
            <img loading="lazy" decoding="async" src="{{ asset('storage/' . $member->image) }}" alt="Scarlet Pena"
                class="rounded w-100" width="300" height="332">
            <ul class="card-social list-inline">
                <li class="list-inline-item"><a target="_blank" class="facebook" href="{{ $member->fb_url ?? '#'}}"><i
                            class="fab fa-facebook"></i></a>
                </li>
                <li class="list-inline-item"><a target="_blank" class="twitter" href="{{ $member->twi_url ?? '#' }}"><i
                            class="fab fa-twitter"></i></a>
                </li>
                <li class="list-inline-item"><a class="instagram" target="_blank"
                        href="{{  $member->inst_url ?? '#' }}"><i class="fab fa-instagram"></i></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h3>{{ ucwords($member->name) }}</h3>
            <p>{{ ucwords($member->designation) }}</p>
        </div>
    </div>
</div>