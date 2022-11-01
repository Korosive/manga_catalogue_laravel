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
                <form method="/search" method="GET">
                    @if (isset($search))
                        <input type="text" name="q" id="q" value="{{ $q }}" />
                    @else
                        <input type="text" name="q" id="q" />
                    @endif
                    <input type="submit" value="Search" />
                </form>
                <table class="table mt-3  text-left">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">English Title</th>
                            <th scope="col">Japanese Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Original Run</th>
                            <th scope="col">Status</th>
                            <th scope="col">Add To List</th>
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
                                @php
                                    $mangaauthor = "";
                                @endphp
                                @if (count($result->authors) > 1)
                                    @foreach($result->authors as $author)
                                        @if ($loop->last)
                                            @php
                                                $mangaauthor .= $author->name;
                                            @endphp                                  
                                        @else
                                            @php
                                                $mangaauthor .= $author->name . ", ";
                                            @endphp
                                        @endif
                                    @endforeach
                                @elseif (count($result->authors) == 1)
                                    @php
                                        $mangaauthor = $result->authors[0]->name;
                                    @endphp
                                @else
                                    @php
                                        $mangaauthor = "-";
                                    @endphp
                                @endif
                                {{ $mangaauthor }}
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
                                    {{ substr($result->published->to, 0, strpos($result->published->to, "T")) }} 
                                @endif
                            </td>
                            <td>
                                {{ $result->status }}
                            </td>
                            <td>
                                <form action="/search/add" method="POST">
                                    @csrf
                                    <input type="hidden" name="mal_id" id="mal_id" value="{{ $result->mal_id }}" />
                                    <input type="hidden" name="eng_title" id="eng_title" value="{{ $result->title }}" />
                                    <input type="hidden" name="jp_title" id="jp_title" value="{{ $result->title_japanese }}" />
                                    <input type="hidden" name="author" id="author" value="{{ $mangaauthor }}" />
                                    <input type="hidden" name="run_start" id="run_start" value="{{ substr($result->published->from, 0, strpos($result->published->from, 'T')) }}" />
                                    <input type="hidden" name="run_end" id="run_end" value="{{ substr($result->published->to, 0, strpos($result->published->to, 'T')) }}" />
                                    <select class='form-select' name='status' id='status'>
                                        <option value='Reading'>Reading</option>
                                        <option value='Completed'>Completed</option>
                                        <option value='On-Hold'>On-Hold</option>
                                        <option value='Dropped'>Dropped</option>
                                        <option value='Planned To Read'>Planned To Read</option>
                                    </select>
                                    <input type="submit" name=""/>
                                </form> 
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
                    @if (isset($q))
                        <a href='/search?q={{ $q }}&page={{ $page - 1}}'>Previous</a>
                    @else
                        <a href='/search?page={{ $page - 1}}'>Previous</a>
                    @endif
                @else
                    <a>Previous</a>
                @endif

                @if ($pagination->has_next_page == TRUE && $page < $pagination->items->total)
                    @if (isset($q))
                        <a href="/search?q={{ $q }}&page={{ $page + 1}}">Next</a>
                    @else
                        <a href="/search?page={{ $page + 1 }}">Next</a>
                    @endif
                @else
                    <a>Next</a>
                @endif
            </div>
        </div>
    <a href="/">Home</a>
</div>
</body>
</html>