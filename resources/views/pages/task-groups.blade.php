<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
                <x-nav-buttons />
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-task-groups
                    :formAction="$formAction"
                    :taskGroups="$taskGroups" />
                <x-made-with />
            </div>
        </div>
    </div>
</x-app-layout>
