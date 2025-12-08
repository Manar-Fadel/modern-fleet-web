<div class="flex grow justify-start pt-5 lg:pt-7.5 mb-5 pl-5">
    <div class="grid gap-5 mt-5 d-flex justify-content-between align-items-center">
        <div class="pagination pagination-sm justify-content-end">
            <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                <div class="flex justify-between flex-1 sm:hidden">
                    <button  v-if="previousPage != null" @click="fetch(previousPage)" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700">
                        « Previous
                    </button>
                    <span v-if="previousPage == null" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                        « Previous
                    </span>

                    <button v-if="nextPage != null" @click="fetch(nextPage)" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700">
                        Next »
                    </button>

                    <span v-if="nextPage == null" class="relative inline-flex items-center ml-3 px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600" >
                        Next »
                    </span>
                </div>
            </nav>

        </div>
    </div>
</div>
