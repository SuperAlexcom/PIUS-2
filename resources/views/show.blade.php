<h1>Category: {{ $category->name }}</h1>

<h2>List of banners:</h2>

@foreach($banners as $banner)
    <li>{{ $banner->name }}</li>
    <a href="{{ $banner->url }}"><img src="{{ asset($banner->image_path) }}" alt="Image not found"></a>
    <br><br>
@endforeach