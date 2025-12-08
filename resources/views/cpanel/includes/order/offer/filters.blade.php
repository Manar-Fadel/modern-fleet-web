<div class="container-fixed flex flex-wrap gap-2.5 mt-5 mr-6 lg:gap-5 mr-6 pb-2.5">
    <input name="search_word" id="search_word"
           v-model="search_word" :name="search_word" :id="search_word" value="{{ isset($_GET['search_word']) ? $_GET['search_word'] : '' }}"
           placeholder="Search by offer number or delivery location description.." class="input" style="width: 350px;" />

    <select name="offer_status" id="offer_status"
            v-model="offer_status" :name="offer_status" :id="offer_status" class="select select-sm w-28">
        <option value="">
            Status
        </option>
        @foreach($offer_statuses as $status)
            <option value="{{ $status->name }}">
                {{ $status->value }}
            </option>
        @endforeach
    </select>

    <select name="is_with_vat" id="is_with_vat"
            v-model="is_with_vat" :name="is_with_vat" :id="is_with_vat" class="select select-sm w-28">
        <option value="">
            Is With Vat?
        </option>
        <option value="1" :value="1">{{ __('web.with vat') }}</option>
        <option value="0" :value="0">{{ __('web.without vat') }}</option>
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

    <select name="week" id="week" v-if="user_id == null" v-model="week" :name="week" :id="week" class="select select-sm w-28">
        <option value="">
            Week
        </option>
        @foreach($weeks as $key => $week)
            <option value="{{ $key }}" {{ isset($_GET['week']) && $_GET['week'] == $key ? "selected":"" }}>
                {{ $week }}
            </option>
        @endforeach
    </select>

    <button @click="emptyOffersFilters();" type="button" class="btn btn-sm btn-outline btn-warning mr-5" style="float: right;">
        <i class="ki-filled ki-trash">
        </i>
        clear Filters
    </button>
    <button @click="fetchOffers();" type="button" class="btn btn-sm btn-outline btn-primary mr-5" style="float: right;">
        <i class="ki-filled ki-setting-4">
        </i>
        Filters
    </button>
</div>
