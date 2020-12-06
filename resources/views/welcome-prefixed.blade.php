<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', XT_app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ XT_csrf_token() }}">

    <title>{{ XT_config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ XT_mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div class="container mx-auto mt-16">
        <h1 class="my-8">A List of Articles, loaded with Laravel Eloquent model into
            a Blade view</h1>
        <p class="mb-4">
            The list of articles are generared with Laravel v8 and Tailwind CSS v1.9.
        </p>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div
                        class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table
                            class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($articles as $article)
                                <tr
                                    class="{{ 0 === $loop->index % 2 ? 'bg-white' : 'bg-gray-50' }}">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $article->id }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $article->title }}
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
