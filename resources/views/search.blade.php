<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manga</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one m-5">PHP Laravel Project - CRUD</h1>

                <table class="table mt-3  text-left">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">English Title</th>
                            <th scope="col">Japanese Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Original Run</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mangas as $result) 
                        <tr>
                            <td><img src="{{ $result->images->jpg->small_image_url }}" alt="Front cover of manga"/></td>
                            <td>
                                @if ($result->title == "" || $result->title == NULL)
                                    -
                                @else
                                    {{ $result->title }}
                                @endif
                            </td>
                            <td>
                                @if ($result->title_japanese == "" || $result->title_japanese == NULL)
                                    -
                                @else
                                    {{ $result->title_japanese }}
                                @endif
                            </td>
                            <td>
                                @if (count($result->authors) > 1)
                                    @foreach($result->authors as $author)
                                        @if ($loop->last)
                                            {{ $author->name }}
                                        @else
                                            {{ $author->name, }}
                                        @endif
                                    @endforeach
                                @elseif (count($result->authors) == 1)
                                    {{ $result->authors[0]->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($result->published->from == "")
                                    ?
                                @else
                                    {{ substr($result->published->from, 0, strpos($result->published->from, "T")) }}
                                @endif
                                 - 
                                @if ($result->published->to == "")
                                    ?
                                @else
                                    {{ substr($result->published->to, 0, strpos($result->published->to, "T"))}} 
                                @endif
                            </td>
                            <td>
                                {{ $result->status }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="1">No mangas found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($page > 1)
                    <a href='/search?page={{ $page - 1}}'>Previous</a>
                @else
                    <a>Previous</a>
                @endif

                @if ($pagination->has_next_page == TRUE && $page < $pagination->items->total)
                    <a href="/search?page={{ $page + 1 }}">Next</a>
                @else
                    <a>Next</a>
                @endif
            </div>
        </div>
    <a href="/">Home</a>
</div>
</body>
</html>