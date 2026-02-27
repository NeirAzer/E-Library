<h1 class="text-2xl font-bold text-gray-800">Welcome to the Dashboard</h1>
<br>
<p>Current User: {{ auth()->user()->name }} -> {{ auth()->user()->role }} -> {{ auth()->user()->password }}</p>