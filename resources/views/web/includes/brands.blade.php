<section class="rts-brand-area" id="brandsSection">
    <div class="container">
        <div class="section-inner">
            <ul>
                @foreach($brands as $brand)
                    <li class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">
                        <img src="{{ $brand->logo }}" alt="{{ $brand->name_en }}">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
