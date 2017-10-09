@foreach($news as $val)
<li class="news-item">
    <div class="news-content">
        <p><a href="{{ $val->link }}" target="_blank">{{ $val->title}}</a></p>
        <p>{{ $val->description }}</p>
        <p>{{ $val->pubDate }}</p>
    </div>
</li>
@endforeach