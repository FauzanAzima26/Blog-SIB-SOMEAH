<!-- Latest News Start -->
<div class="container-fluid latest-news py-5">
    <div class="container py-5">
        <h2 class="mb-4">Latest News</h2>
        <div class="latest-news-carousel owl-carousel">
            @foreach ($main_post_all as $item)
                <div class="latest-news-item">
                    <div class="bg-light rounded">

                        <div class="rounded-top overflow-hidden">
                            <img src="{{ asset('storage/images/' . $item->image) }}"
                                class="img-zoomin img-fluid rounded-top w-100" alt="">
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="#" class="h4">{{$item->title}}</a>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="small text-body link-hover">by {{ $item->user->name }}</a>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                    {{$item->published_at}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Latest News End -->