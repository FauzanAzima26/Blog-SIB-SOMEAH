<!-- Most Populer News Start -->
<div class="container-fluid populer-news py-5">
    <div class="container py-5">
        <div class="tab-class mb-4">
            <div class="row g-4">
                <div class="col-lg-8 col-xl-9">
                    <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                        <h1 class="mb-4">What’s New</h1>
                        <ul class="nav nav-pills d-inline-flex text-center">
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 bg-light rounded-pill active me-2" data-bs-toggle="pill"
                                    href="#teknologi">
                                    <span class="text-dark" style="width: 100px;">Teknologi</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#berita">
                                    <span class="text-dark" style="width: 100px;">Berita</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill"
                                    href="#olahraga">
                                    <span class="text-dark" style="width: 100px;">Olahraga</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#game">
                                    <span class="text-dark" style="width: 100px;">Game</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#tab-5">
                                    <span class="text-dark" style="width: 100px;">Fashion</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content mb-4">
                        <div id="teknologi" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-8">
                                    @foreach ($categorys as $main_post)
                                @if($main_post->category->name == "Teknologi")
                                            <div class="position-relative rounded overflow-hidden">
                                                <img src="{{ asset('storage/images/' . $main_post->image) }}"
                                                    class="img-zoomin img-fluid rounded w-100" alt="">
                                            </div>
                                            <div class="my-4">
                                                <a href="#" class="h4">{{$main_post->title}}</a>
                                            </div>
                                            <p class="my-4">
                                                {{$main_post->content}}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i> {{$main_post->views}} Views</a></a>
                                            </div>
                    
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row g-4">
                                                @foreach ($main_post_all_category as $item)
                                                @if ($item->category->name == 'Teknologi')
                                                      
                                                <div class="col-12">
                                                    <div class="row g-4 align-items-center">
                                                        <div class="col-5">
                                                            <div class="overflow-hidden rounded">
                                                                <img src="{{ asset('storage/images/' . $item->image) }}"
                                                                    class="img-zoomin img-fluid rounded w-100" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="features-content d-flex flex-column">
                                                                <p class="text-uppercase mb-2">{{$item->category->name}}</p>
                                                                <a href="#" class="h6"> {{$item->title}} </a>
                                                                <small class="text-body d-block"><i
                                                                        class="fas fa-calendar-alt me-1"></i> {{$item->published_at}} </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                            </div>
                        </div>

                        <div id="berita" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                        <div class="col-lg-8">
                                            @foreach ($categorys as $main_post)
                                            
                                       
                                            @if($main_post->category->name == 'Berita')

                                            <div class="position-relative rounded overflow-hidden">
                                                <img src="{{ asset('storage/images/' . $main_post->image) }}"
                                                    class="img-zoomin img-fluid rounded w-100" alt="">
                                            </div>
                                            <div class="my-3">
                                                <a href="#" class="h4">{{ $main_post->title }}</a>
                                            </div>
                                            <p class="mt-4">{{ substr($main_post->content, 0, 200) }}...</p>
                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i>
                                                    {{ $main_post->views }} views</a>
                                            </div>

                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row g-4">
                                            @foreach($main_post_all_category as $item)
                                            @if($item->category->name == "Berita")
                                                <div class="col-12">
                                                    <div class="row g-4 align-items-center">
                                                        <div class="col-5">
                                                            <div class="overflow-hidden rounded">
                                                                <img src="{{ asset('storage/images/' . $item->image) }}"
                                                                    class="img-zoomin img-fluid rounded w-100" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="features-content d-flex flex-column">
                                                                <p class="text-uppercase mb-2">{{ $item->category->name }}</p>
                                                                <a href="#" class="h6"> {{ $item->title }} </a>
                                                                <small class="text-body d-block"><i
                                                                        class="fas fa-calendar-alt me-1"></i>
                                                                    {{ $item->published_at }} </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div> 
                            </div>
                        </div>

                        <div id="olahraga" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-8">
                                    @foreach ($categorys as $main_post)
                                    @if($main_post->category->name == 'Olahraga')
                                    <div class="position-relative rounded overflow-hidden">
                                        <img src="{{ asset('storage/images/' . $main_post->image) }}"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                    </div>
                                    <div class="my-3">
                                        <a href="#" class="h4">{{ $main_post->title }}</a>
                                    </div>
                                    <p class="mt-4">{{ substr($main_post->content, 0, 200) }}...</p>
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i> {{ $main_post->views }} views}} </a>
                                    </div>

                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-lg-4">
                                    <div class="row g-4">
                                        @foreach($main_post_all_category as $item)
                                        @if($item->category->name == "Olahraga")
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('storage/images/' . $item->image) }}"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2"> {{ $item->category->name }} </p>
                                                        <a href="#" class="h6"> {{ $item->title }} </a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> {{ $item->published_at }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="game" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-8">
                                    <div class="position-relative rounded overflow-hidden">
                                        <img src="{{ asset('assets/frontend') }}/img/news-1.jpg"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                        <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                            style="top: 20px; right: 20px;">
                                            Technology
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" class="h4">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry.</a>
                                    </div>
                                    <p class="mt-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy Lorem Ipsum has
                                        been the industry's standard dummy
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-clock"></i> 06
                                            minute read</a>
                                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i> 3.5k
                                            Views</a>
                                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-comment-dots"></i>
                                            05 Comment</a>
                                        <a href="#" class="text-dark link-hover"><i class="fa fa-arrow-up"></i> 1.5k
                                            Share</a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-3.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Technology</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-4.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Technology</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-5.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Technology</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-6.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Technology</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-7.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Technology</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-5" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-8">
                                    <div class="position-relative rounded overflow-hidden">
                                        <img src="{{ asset('assets/frontend') }}/img/news-1.jpg"
                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                        <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                            style="top: 20px; right: 20px;">
                                            Fashion
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <a href="#" class="h4">World Happiness Report 2023: What's the highway to
                                            happiness?</a>
                                    </div>
                                    <p class="mt-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy Lorem Ipsum has
                                        been the industry's standard dummy
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-clock"></i> 06
                                            minute read</a>
                                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-eye"></i> 3.5k
                                            Views</a>
                                        <a href="#" class="text-dark link-hover me-3"><i class="fa fa-comment-dots"></i>
                                            05 Comment</a>
                                        <a href="#" class="text-dark link-hover"><i class="fa fa-arrow-up"></i> 1.5k
                                            Share</a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-3.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Fashion</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-4.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Fashion</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-5.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Fashion</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-6.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Fashion</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-5">
                                                    <div class="overflow-hidden rounded">
                                                        <img src="{{ asset('assets/frontend') }}/img/news-7.jpg"
                                                            class="img-zoomin img-fluid rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">Fashion</p>
                                                        <a href="#" class="h6">Get the best speak market, news.</a>
                                                        <small class="text-body d-block"><i
                                                                class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                            2024</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Most Populer News End -->