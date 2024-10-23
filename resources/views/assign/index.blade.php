<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white">
    @if(session('status') == 'permission-assigned')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">Permission Assigned Successfully</span>
        </div>
    @endif
    @if(session('status') == 'permission-removed')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">Permission Removed Successfully</span>
        </div>
    @endif
    <form class="max-w-sm mx-auto" action="{{ url('api/assign') }}" method="POST">
        @csrf

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User</label>
                <select id="user" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label for="permission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission</label>
                <select id="permission" name="permission_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 flex items-end">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full" type="submit">
                    Assign
                </button>
            </div>
        </div>
    </form>

    <table class="w-full text-sm text-left rtl:text-righ">
        <thead class="text-xsuppercase">
            <tr>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Permissions
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->permissions as $permission)
            <tr class="hover:bg-gray-50">
                <td class="pl-6 py-4 w-0.5">
                    {{ $user->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $permission->name }}
                </td>
                <td class="px-6 py-4">
                    <form action="api/assign" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded" type="submit">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
