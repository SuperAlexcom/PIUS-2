@if ($children->count())
    <ul style="margin-left: 20px;">
        @foreach($children as $child)
            <li>
                <a href="{{ route('categories.show', $child->slug) }}"> {{ $child->name }}</a>
            </li>
            @include('categories.children', ['children' => $child->children])
        @endforeach
    </ul>
@endif