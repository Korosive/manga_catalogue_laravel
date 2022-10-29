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
                            <th scope="col">Product Title</th>
                            <th scope="col" class="pr-5">Price (USD)</th>
                            <th scope="col">Short Notes</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mangas as $manga)
                        <tr>
                            <td>{!! $manga->eng_title !!}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No products found</td>
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