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
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table mt-3  text-left">
                    <thead>
                        <tr>
                            <th scope="col">English Title</th>
                            <th scope="col">Japanese Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Original Run</th>
                            <th scope="col">Status</th>
                            <th scope="col">Change Status?</th>
                            <th scope="col">Remove?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mangas as $manga)
                        <tr>
                            <td>{{ $manga->eng_title }}</td>
                            <td>{{ $manga->jp_title }}</td>
                            <td>{{ $manga->author }}</td>
                            <td>{{ $manga->run_start }} - {{ $manga->run_end }}</td>
                            <td>{{ $manga->status }}</td>
                            <td>
                                <form method="POST" action="/update_status">
                                    @csrf
                                    <input type="hidden" name="record_id" id="record_id" value="{{ $manga->id }}" />
                                    <select class='form-select' name='status' id='status'>
                                        <option value='Reading'>Reading</option>
                                        <option value='Completed'>Completed</option>
                                        <option value='On-Hold'>On-Hold</option>
                                        <option value='Dropped'>Dropped</option>
                                        <option value='Planned To Read'>Planned To Read</option>
                                    </select>
                                    <input type="submit" name="Submit" value="Update Status" />
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="/remove">
                                    @csrf
                                    <input type="hidden" name="record_id" id="record_id" value="{{ $manga->id }}" />
                                    <input type="submit" name="Submit" value="Remove" />
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No manga found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    <a href='/search?page=1'>Search Database</a>
</div>
</body>
</html>