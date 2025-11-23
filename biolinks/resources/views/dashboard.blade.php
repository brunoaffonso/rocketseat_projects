<div>

    <h1>Dashboard</h1>

    <ul>
        @foreach ($links as $link)
            <li>
                <a href="{{ route('links.edit', $link) }}">{{ $link->name }}</a>
            </li>
        @endforeach
    </ul>

</div>
