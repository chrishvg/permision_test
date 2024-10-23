<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white">
@if(session('status') == 'permission-added')
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">Permission Created Successfully</span>
    </div>
@endif
@if(session('status') == 'permission-deleted')
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">Permission Deleted Successfully</span>
    </div>
@endif
<form action="/api/permission" method="POST">
    @csrf
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 pt-2" for="grid-first-name">
        Name
    </label>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" name="name">
        </div>
        <div class="w-full md:w-1/2 px-3 inline-block align-middle ">
            <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Add New Permission
            </button>
        </div>
    </div>
</form>
@if($permissions->count() > 0)
<table class="w-full text-sm text-left rtl:text-righ">
    <thead class="text-xsuppercase">
        <tr>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
        <tr class="hover:bg-gray-50">
            <td class="pl-6 py-4 w-0.5">
                {{ $permission->name }}
            </td>
            <td class="px-6 py-4">
                <form action="api/permission" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $permission->id }}">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded" type="submit">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> <div
    <span class="block sm:inline">No Permissions Found</span>
</div>
@endif
</div>
</x-app-layout>
