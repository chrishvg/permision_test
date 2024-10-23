<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        @if(session('status') == 'user-enabled')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">Enabled Successfully</span>
        </div>
        @endif
        @if(session('status') == 'user-deleted')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">Desnabled Successfully</span>
            </div>
        @endif
        @if(session('status') == 'user-added')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">User Added Successfully</span>
            </div>
        @endif
        @if(session('status') == 'user-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">User Updated Successfully</span>
            </div>
        @endif
        <table class="w-full text-sm text-left rtl:text-righ">
            <thead class="text-xsuppercase">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Admin / User
                    </th>
                    <th scope="col" class="px-6 py-3">
                        First Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Is Enabled
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users->all() as $user)
                <tr class="hover:bg-gray-50">
                    <td class="pl-6 py-4 w-0.5">
                        @if ($user->is_admin)
                            <svg class="w-3 h-5 me-2.5" title="admin" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25"/>
                        </svg>
                        @else
                            <svg class="w-3 h-5 me-2.5" title="user" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->last_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->phone }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($user->is_enabled)
                            <svg class="h-8 w-8 text-green-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="20 6 9 17 4 12" /></svg>
                        @else
                            <svg class="h-8 w-8 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="18" y1="6" x2="6" y2="18" />  <line x1="6" y1="6" x2="18" y2="18" /></svg>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex items-center">
                        @if (in_array('edit', $permitsAllowed))
                            <div class="pr-2">
                                <a href="{{ route('user.edit', $user->id) }}" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 font-medium rounded text-sm px-5 py-2.5 focus:outline-none">Edit</a>
                            </div>
                        @endif
                        @if ($user->is_enabled && in_array('desactivate', $permitsAllowed))
                            <form action="api/user" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded" type="submit">
                                    Desactivate
                                </button>
                            </form>
                        @endif
                        @if (!$user->is_enabled && in_array('activate', $permitsAllowed))
                            <div>
                                <a href="{{ route('user.enabled', $user->id) }}" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 font-medium rounded text-sm px-5 py-2.5 focus:outline-none">Activate</a>
                            </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
