<div>
   <div class="section">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-lg-10">
               <div class="mb-5">
                  <h2 class="mb-4" style="line-height:1.5">
                     {{ ucfirst($article->title) }}
                  </h2>
                  <span>{{ Carbon\Carbon::parse($article->created_at)->format('d M Y') }} <span class="mx-2">/</span>
                  </span>
                  <p class="list-inline-item">Category : <a
                        href="{{ route('blog_page',['category_id'=> $article->category->id,'category_slug'=> $article->category->slug]) }}"
                        class="ml-1">{{ $article->category->category_name
                        }}</a>
                  </p>
                  <p class="list-inline-item">Author : <a href="#" class="ml-1">{{ $article->author_name }} </a> 
                  </p>

                  {{-- <p class="list-inline-item">Tags : <a href="#" class="ml-1">Photo </a> ,<a href="#!"
                        class="ml-1">Image </a>
                  </p> --}}
               </div>
               <div class="mb-5 text-center">
                  <div class="post-slider rounded overflow-hidden">
                     <img loading="lazy" decoding="async" src="{{ asset('storage/'. $article->article_image) }}"
                        alt="{{ $article->title }}">

                  </div>
               </div>
               <div class="content">
                  {!! $article->content !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>