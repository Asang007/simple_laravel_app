<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User App</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <div class="sm:mx-auto sm:w-full sm:max-w-md pt-10">
    <img class="mx-auto h-24 w-auto" src="https://www.logaster.com/blog/wp-content/uploads/2018/05/LogoMakr.png" alt="Workflow">
    <h2 class="mt-0 text-center text-3xl font-extrabold text-gray-900">
      Sign In
    </h2>
  </div>
  <form action="signin" method="POST">
    @csrf
    <div class="pl-4 pr-4 mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">

        @if ($message = Session::get('error'))
          <div class="mt-5 mb-5">
            <strong class="text-red-500">{{ $message }}</strong>
          </div>
        @endif

        @if ( isset($errors) && count($errors) > 0)
          <div>
            <ul>
              @foreach($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form class="space-y-6" action="#" method="POST">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email
            </label>
            <div class="mt-1">
              <input id="email" name="email" type="email" autocomplete="off" placeholder="Your email address" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
          </div>
          <div class="pt-5">
            <label for="password" class="block text-sm font-medium text-gray-700">
              Password
            </label>
            <div class="mt-1">
              <input id="password" name="password" type="password" placeholder="***********" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
          </div>
          <div class="pt-10">
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Sign In
            </button>
          </div>
        </form>
      </div>
    </div>
  </form>
</body>
</html>