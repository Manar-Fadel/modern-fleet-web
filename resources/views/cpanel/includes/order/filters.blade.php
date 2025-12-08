<form method="get" action="{{ route("admin.orders.export") }}">
    <div class="container-fixed flex flex-wrap gap-2.5 mr-6 lg:gap-5 mr-6 pb-2.5">

        <input type="hidden" name="stat_start_date" id="stat_start_date"
               value="{{ isset($_GET['stat_start_date']) ? $_GET['stat_start_date'] : null }}">

        <input type="hidden" name="stat_to_date" id="stat_to_date"
               value="{{ isset($_GET['stat_to_date']) ? $_GET['stat_to_date'] : null }}">

        <input name="search_word" id="search_word" v-model="search_word" :name="search_word" :id="search_word" value="{{ isset($_GET['search_word']) ? $_GET['search_word'] : '' }}"
               placeholder="Search by order number or description.." class="input max-w-[380px]" />

        <select name="brand_id" id="brand_id"
                v-model="brand_id" :name="brand_id" :id="brand_id" class="select select-sm w-28">
            <option value="">
                Brand
            </option>
            @foreach($brands as $key => $brand)
                <option value="{{ $key }}">
                    {{ $brand }}
                </option>
            @endforeach
        </select>

        <select name="year" id="year"
                v-model="year" :name="year" :id="year" class="select select-sm w-28">
            <option value="">
                Year
            </option>
            @foreach($years as $year)
                <option value="{{ $year }}" {{ isset($_GET['year']) && $_GET['year'] == $year ? "selected":"" }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>

        <select name="month" id="month"
                 v-model="month" :name="month" :id="month" class="select select-sm w-28">
            <option value="">
                Month
            </option>
            @foreach($months as $key => $month)
                <option value="{{ $key }}" {{ isset($_GET['month']) && $_GET['month'] == $key ? "selected":"" }}>
                    {{ $month }}
                </option>
            @endforeach
        </select>

        <select name="week" id="week"
                v-model="week" :name="week" :id="week" class="select select-sm w-28">
            <option value="">
                Week
            </option>
            @foreach($weeks as $key => $week)
                <option value="{{ $key }}" {{ isset($_GET['week']) && $_GET['week'] == $key ? "selected":"" }}>
                    {{ $week }}
                </option>
            @endforeach
        </select>

        <div class="container-fixed gap-2.5">
            <button @click="emptyFilters();" type="button" class="btn btn-sm btn-outline btn-warning mr-5" style="float: right;">
                <i class="ki-filled ki-trash">
                </i>
                clear Filters
            </button>
            <button @click="fetchOrders();" type="button" class="btn btn-sm btn-outline btn-primary mr-5" style="float: right;">
                <i class="ki-filled ki-setting-4">
                </i>
                Filters
            </button>
        </div>
    </div>
</form>
