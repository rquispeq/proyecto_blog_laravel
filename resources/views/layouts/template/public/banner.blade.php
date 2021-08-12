<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">
            @foreach($posts as $post)
                @if($post->banner == 1)
                <div class="item">
                    <img src="template/public/assets/images/banner-item-01.jpg" alt="">
                    <div class="item-content">
                        <div class="main-content">
                            <div class="meta-category">
                                <span>{{$post->category->name}} </span>
                            </div>
                            <a href="post-details.html">
                                <h4>
                                    {{$post->title}}
                                </h4>
                            </a>
                            <ul class="post-info">
                                <li><a href="#">{{$post->user->name}}</a></li>
                                <li><a href="#">{{$post->getCreationTime()}}</a></li>
                                <li><a href="#">12 Comments</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- Banner Ends Here -->