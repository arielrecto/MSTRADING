<aside class="w-64" aria-label="Sidebar">
    <div class="overflow-y-auto py-4 px-3 bg-blue-400 rounded dark:bg-gray-800 min-h-screen">
       <ul class="space-y-2">
         <li>
            <x-sidebar-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
               <i class="ri-dashboard-line mr-2 text-2xl"></i>       
                       {{ __('Dashboard') }}
               
            </x-sidebar-link>
            
         </li>
          <li>
            <x-sidebar-link :href="route('admin.salary.show')" :active="request()->routeIs(['admin.salary.show', 'admin.payroll.index', 'admin.payroll.show', 'admin.doublepay.index'])">
               <i class="ri-pie-chart-2-line mr-2 text-2xl"></i>        
                      {{ __('Salaries') }}
               
            </x-sidebar-link>
          </li>
          <li>
            <x-sidebar-link :href="route('admin.employee.index')" :active="request()->routeIs(['admin.employee.index', 'admin.employee.addprofile', 'admin.employee.edit', 'admin.employee.archive', 'admin.employee.show'])">

               <i class="ri-group-line mr-3 text-2xl"></i>
               {{ __('Employees') }}
               
            </x-sidebar-link>
          </li>
          <li>
            <x-sidebar-link :href="route('admin.product.index')" :active="request()->routeIs(['admin.product.index' ,'admin.product.create', 'admin.product.edit', 'admin.product.stock', 'admin.product.recieved', 'admin.category.index', 'admin.category.edit', 'admin.category.create', 'admin.supplier.index', 'admin.supplier.create'])">

               <i class="ri-stack-line mr-2 text-2xl"></i>
               {{ __('Inventory') }}
               
            </x-sidebar-link>
          </li>
          <li>
            <x-sidebar-link :href="route('admin.position.show')" :active="request()->routeIs(['admin.position.show'])">

               <i class="ri-user-add-line mr-2 text-2xl"></i>
               {{ __('Position') }}
               
            </x-sidebar-link>
          </li>
          <li>
            <x-sidebar-link :href="route('admin.attendance.index')" :active="request()->routeIs(['admin.attendance.index'])">

               <i class="ri-calendar-check-line text-2xl mr-2"></i>
               {{ __('Employee Attendance') }}
               
            </x-sidebar-link>
          </li>
          <li>
            <x-sidebar-link :href="route('admin.deduction.index')" :active="request()->routeIs(['admin.deduction.index'])">

               <i class="ri-exchange-dollar-line text-2xl mr-2"></i>
               {{ __('Salary Deduction') }}
               
            </x-sidebar-link>
          </li>
          <li>
            <x-sidebar-link :href="route('admin.absent.index')" :active="request()->routeIs(['admin.absent.index'])">

               <i class="ri-exchange-dollar-line text-2xl mr-2"></i>
               {{ __('Request Leave') }}
               
            </x-sidebar-link>
          </li>
       </ul>
       
    </div>
 </aside>
 