<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User App</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="ml-8 mr-8">
  <h1 class="text-xl mt-5 mb-5">Dashboard</h1>
  <h2 class="text-xl mt-5 mb-5">Hello {{ Auth::user()->name }}</h2>
  <table class="table-fixed border-2 border-blue-200">
    <thead>
      <tr>
        <th class="w-auto border-2 border-blue-200">No</th>
        <th class="w-1/4 border-2 border-blue-200">Name</th>
        <th class="w-1/4 border-2 border-blue-200">Email</th>
        <th class="w-1/4 border-2 border-blue-200">Position</th>
        <th class="w-1/4 border-2 border-blue-200">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($user_data as $user)
        <tr>
          <td class="border-2 border-blue-200 text-center pl-1 pr-1">{{ $user->id }}</td>
          <td class="border-2 border-blue-200 text-center pl-1 pr-1">{{ $user->name }}</td>
          <td class="border-2 border-blue-200 text-center pl-1 pr-1">{{ $user->email }}</td>
          <td class="border-2 border-blue-200 text-center pl-1 pr-1">{{ $user->userRole[0]->position }}</td>
          <td class="border-2 border-blue-200 text-center pl-1 pr-1">{{ $user->userRole[0]->status }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="pt-10">
    <a href="/signout" type="submit" class="w-auto flex justify-center text-md py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
      Sign Out
    </a>
  </div>
</body>
</html>

