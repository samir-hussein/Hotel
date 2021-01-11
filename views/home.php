<section id="sec1">
    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: push;autoplay: true;max-height: 650">

    <ul class="uk-slideshow-items">
    <?php
if (isset($this->loadData['home_slider'])) {
    foreach ($this->loadData['home_slider'] as $row) {
        ?>
                <li>
                    <img src="/assets/images/<?=$row['image']?>" alt="home slider" uk-cover>
                    <div data-wow-duration="3s" class="wow fadeInUp uk-overlay uk-overlay-primary uk-position-bottom uk-text-center">
                        <h3 class="uk-margin-remove"><?=$row['h']?></h3>
                        <p class="uk-margin-remove"><?=$row['p']?></p>
                    </div>
                </li>
                <?php
}
}
?>
    </ul>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

    </div>
</section>

<section id="sec2" class="p-5">
<h2 class="uk-heading-line uk-text-center"><span>check availability</span></h2>
<form action="">
    <div data-wow-duration="3s" class= "wow fadeInUp row w-75 m-auto uk-box-shadow-small p-3 mt-5">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-select">check in</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="date" id="in">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-select">check out</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="date" id="out">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="uk-margin">
                <label class="uk-form-label">room type</label>
                <div class="uk-form-controls">
                <select id="room_type" class="uk-select" aria-label="Default select example" multiple="multiple">
                <?php
if (isset($this->loadData['rooms_types'])) {
    foreach ($this->loadData['rooms_types'] as $row) {
        ?>
                            <option value="<?=$row['name']?>"><?=$row['name']?></option>
                            <?php
}
} else {
    ?>
    <option value="">no rooms available now</option>
    <?php
}
?>
                </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-select">number of rooms</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="number_of_rooms" placeholder="0">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-select">adults</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="adults" placeholder="0">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-select">children (1 - 13) years</label>
                <div class="uk-form-controls">
                <input class="uk-input" type="text" id="children" placeholder="0">
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 d-flex align-items-end">
            <div class="uk-margin w-100">
            <button id="submit" type="submit" class="btn w-100">Check Availability</button>
            </div>
        </div>
    </div>
</form>
</section>

<section id="sec3" class="p-5">
<h2 class="text-center">Amazing Hotel in front of the Sea</h2>
<?php
if (isset($this->loadData['about_us'])) {
    foreach ($this->loadData['about_us'] as $row) {
        ?>
            <p data-wow-duration="3s" class= "wow fadeInUp text-center w-50 m-auto fs-6"><?=$row['p']?></p>
            <div class="p-3" id="video">
                <button class= "d-block m-auto mb-3 uk-button uk-button-default uk-margin" type="button" uk-toggle="target: +">watch Video</button>

                <video class="w-50 m-auto d-block" src="/assets/videos/<?=$row['vedio']?>" controls playsinline hidden uk-video></video>
            </div>
            <?php
}
}
?>
<div class="p-5" id="gallery-part">
<div data-wow-duration="3s" class= "wow fadeInUp uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="autoplay: true;autoplay-interval: 3000">

<ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-4@m uk-grid">
<?php
if (isset($this->loadData['hotel_images'])) {
    foreach ($this->loadData['hotel_images'] as $row) {
        ?>
            <li>
                <div class="uk-panel">
                    <img src="/assets/images/<?=$row['image']?>" alt="hotel images">
                </div>
            </li>
            <?php
}
}
?>
</ul>

<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>
</div>
</section>

<section class="p-5" id="sec4">
    <h2 class="text-center">Rooms & Suites</h2>
<div class="uk-slider-container-offset container" uk-slider="autoplay: true">

<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

    <ul data-wow-duration="3s" class="wow fadeInUp uk-slider-items uk-child-width-1-1 uk-child-width-1-3@m uk-grid">
    <?php
if (isset($this->loadData['rooms_types'])) {
    foreach ($this->loadData['rooms_types'] as $row) {
        ?>
                    <li>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top">
                                <img src="/assets/images/<?=$row['image']?>" alt="">
                            </div>
                            <div class="uk-card-body">
                                <h3 class="uk-card-title"><?=$row['name']?></h3>
                                <p><strong><?=$row['cost']?></strong><small>$</small>/per night</p>
                                <ul class="list-unstyled">
                                    <li class="lh-lg"><strong>adults: </strong><?=$row['adults']?></li>
                                    <?php
if (!empty($row['children'])) {
            ?>
                                            <li class="lh-lg"><strong>children: </strong><?=$row['children']?></li>
                                            <?php
}
        ?>
                                    <li class="lh-lg"><strong>categories: </strong><?=$row['Categories']?></li>
                                    <li class="lh-lg"><strong>facilities: </strong><?=$row['facilities']?></li>
                                    <li class="lh-lg"><strong>bed type: </strong><?=$row['bed_type']?></li>
                                </ul>
                                <a href="/book-now" class="d-block text-center">book now</a>
                            </div>
                        </div>
                    </li>
                <?php
}
}
?>
    </ul>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>

<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

</div>
</section>

<section id="sec5" class="p-5" style="background-image: url('/assets/images/menu.webp');">
    <h2 class="text-center mb-5">Restaurant</h2>
    <div data-wow-duration="3s" class= "wow fadeInUp"uk-filter="target: .js-filter">

    <ul uk-tab class="w-75 me-auto ms-auto d-flex justify-content-center">
    <?php
if (isset($this->loadData['food_departments'])) {
    foreach ($this->loadData['food_departments'] as $row) {
        ?>
                <li class="<?=($row['type'] == 'BREAKFAST') ? 'uk-active' : ''?>" uk-filter-control="[data-color=<?=$row['type']?>]"><a href="#" class="pe-5 ps-5 fs-4 d-block"><?=$row['type']?></a></li>
                <?php
}
}
?>
    </ul>

    <ul class="w-75 m-auto js-filter uk-child-width-1-1 uk-child-width-1-2@m uk-text-center" uk-grid>
    <?php
if (isset($this->loadData['all_foods'])) {
    foreach ($this->loadData['all_foods'] as $row) {
        ?>
                    <li data-color=<?=$row['type']?>>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <div class="uk-width-auto p-0">
                                        <img class="uk-border-circle" width="150" height="150" src="/assets/images/<?=$row['image']?>">
                                    </div>
                                    <div class="uk-width-expand p-0">
                                        <h3 class="m-0 uk-card-title"><?=$row['name']?></h3>
                                        <p class="m-0">$<?=$row['price']?></p>
                                        <p class="m-0"><?=$row['details']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php
}
}
?>
    </ul>

</div>
</section>

<section id="sec6">
    <div class="row">
        <div class="col-12 col-md">
            <h3 data-wow-duration="3s" class="wow fadeInUp text-center">A Best Place To Stay. book Now!</h3>
        </div>
        <div class="col-12 col-md text-center">
            <a data-wow-duration="3s" href="/book-now" class="wow fadeInUp">book now <span uk-icon="arrow-right"></span></a>
        </div>
    </div>
</section>

<section class="p-5" id="sec7">
<h2 class="uk-heading-line uk-text-center mb-5"><span>contact us</span></h2>
    <div class="row">
        <div class="col-12 col-xl mb-3">
            <div>
                <form action="" class="wow fadeInUp uk-box-shadow-small" data-wow-duration="3s">
                    <div class="mb-3">
                        <label class="form-label">name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">subject</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">message</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn d-block m-auto">send</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-xl mb-3" id="map">
            <div class="h-100 wow fadeInUp" data-wow-duration="3s">
            <iframe class="d-block m-auto" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d110502.60399768576!2d31.188252191881773!3d30.05961837876211!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583fa60b21beeb%3A0x79dfb296e8423bba!2sCairo%2C%20Cairo%20Governorate!5e0!3m2!1sen!2seg!4v1608031246892!5m2!1sen!2seg" frameborder="0" style="border:0;width:100%;height:100%;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('#room_type').multiselect({
            buttonWidth: '100%'
        });
    });
</script>

<script>
    $('#submit').click(function(){
        event.preventDefault();
        var checkIn = $('#in').val();
        var checkOut = $('#out').val();
        var roomType = $('#room_type').val();
        var numberOfRooms = $('#number_of_rooms').val();
        var adults = $('#adults').val();
        var children = $('#children').val();
        var arr = [[roomType[0],numberOfRooms]];

        if(roomType.length > 1){
            arr = [];
            var length = roomType.length;
            var i = 0;
            while(length > 0){
                var val = prompt('Number Of '+ roomType[i]);
                arr.push([roomType[i],val]);
                length--;
                i++;
            }
        }

        $.ajax({
            url: "/CheckAvailability/check",
            method: 'POST',
            data: {
                checkIn: checkIn,
                checkOut: checkOut,
                adults: adults,
                children:children,
                arr:arr
            },
            success: function (data) {
                if(data == 'true'){
                    window.location.replace("/book-now?checkIn="+checkIn+"&checkOut="+checkOut+"&numberOfRooms="+numberOfRooms+"&adults="+adults+"&children="+children+"&arr="+arr);
                }else{
                    alert(data);
                }
            },
        });
    });
</script>