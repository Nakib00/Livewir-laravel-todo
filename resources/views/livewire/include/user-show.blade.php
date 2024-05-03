<div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th
                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    First Name</th>
                <th
                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Last Name</th>
                <th
                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Email</th>
                <th
                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Image</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->fname }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->lname }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $user->email }}</td>
                    {{-- show image --}}
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <img class="w-10 h-10 rounded-full"
                            src="{{ asset('storage/' . $user->image) }}"
                            alt="User Image">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
