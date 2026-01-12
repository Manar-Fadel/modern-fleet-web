<div v-if="message != null" :class="{displayactive:message!=null}"
     class="flex items-center gap-2 text-sm font-normal text-gray-700 mt-2 hidden">
    <div v-if="status == false" class="alert alert-danger" style="color: red; padding: 5px 25px; border-radius: 5px; background-color: #f2baba;">
        @{{ message }}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;font-size: 10px;"></button>
    </div>
    <div v-if="status == true" class="alert alert-success" style="color: green; padding: 5px 25px; border-radius: 5px; background-color: #d6fad6;">
        @{{ message }}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;font-size: 10px;"></button>
    </div>

</div>
