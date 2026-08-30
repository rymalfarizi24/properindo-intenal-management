<div class="w-full mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Employee Dashboard
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Overview and summary of employee information.
        </p>
    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

        {{-- Total Employees --}}
        <x-ui.card-stat title="Total Employees" color="blue" :value="$totalEmployees"
            description="Total registered employees">
            <x-slot:icon>
                <x-icons.users size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Active Employees --}}
        <x-ui.card-stat title="Active Employees" color="green" :value="$activeEmployees"
            description="Currently active employees">
            <x-slot:icon>
                <x-icons.user-check size="24" />
            </x-slot:icon>
        </x-ui.card-stat>


        {{-- Inactive Employees --}}
        <x-ui.card-stat title="Inactive Employees" color="red" :value="$inactiveEmployees"
            description="Currently inactive employees">
            <x-slot:icon>
                <x-icons.user-x size="24" />
            </x-slot:icon>
        </x-ui.card-stat>

    </div>


    {{-- Bottom Section --}}
    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-6">

        {{-- Employees by Department --}}
        <section class="col-span-2 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="mb-5">
                <h2 class="font-semibold text-gray-900">
                    Employees by Department
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Employee distribution across departments.
                </p>
            </div>


            <div class="space-y-5">

                @forelse ($employeesByDepartment as $department)

                <div>

                    <div class="mb-2 flex items-center justify-between">

                        <span class="text-sm text-gray-600">
                            {{ $department->department }}
                        </span>

                        <span class="text-sm font-semibold text-gray-900">
                            {{ $department->total }}
                        </span>

                    </div>


                    <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                        <div class="h-full rounded-full bg-blue-500" style="width: {{
                                    $totalEmployees > 0
                                        ? ($department->total / $totalEmployees) * 100
                                        : 0
                                }}%">
                        </div>

                    </div>

                </div>

                @empty

                <div class="py-8 text-center text-sm text-gray-500">
                    No employee data available.
                </div>

                @endforelse

            </div>

        </section>


        {{-- Recent Employees --}}
        <section class="col-span-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">

            <div class="mb-5 flex items-start justify-between">

                <div>

                    <h2 class="font-semibold text-gray-900">
                        Recent Employees
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Recently added employees.
                    </p>

                </div>


                <a href="/dashboard/employees/data" class="text-sm font-medium text-blue-600 hover:underline">

                    View All

                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-gray-100 text-xs uppercase text-gray-500">

                        <tr>
                            <th class="pb-3 font-medium">
                                Employee
                            </th>

                            <th class="pb-3 font-medium">
                                Department
                            </th>

                            <th class="pb-3 font-medium">
                                Status
                            </th>
                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse ($recentEmployees as $employee)

                        <tr>

                            {{-- Employee --}}
                            <td class="py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $employee->name }}
                                </div>

                                <div class="mt-1 text-xs text-gray-500">
                                    {{ $employee->email }}
                                </div>

                            </td>


                            {{-- Department --}}
                            <td class="py-4 text-gray-600">
                                {{ $employee->department }}
                            </td>


                            {{-- Status --}}
                            <td class="py-4">

                                @if ($employee->status)

                                <span class="rounded-full bg-green-50 px-2.5 py-1
                                                   text-xs font-medium text-green-600">

                                    Active

                                </span>

                                @else

                                <span class="rounded-full bg-red-50 px-2.5 py-1
                                                   text-xs font-medium text-red-600">

                                    Inactive

                                </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="py-8 text-center text-gray-500">

                                No employee data available.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </div>

</div>