<?php
$this->title = "Book Now";
?>

<section id="book-now-sec">
    <div>
        <h1 class="text-center">book now</h1>
    </div>
</section>

<section id="book-now-sec2" class="p-5">
    <div class="row w-75 m-auto">
        <div class="col-12">
            <form action="" class="uk-box-shadow-small">
            <?php
if (isset($_GET['checkIn'])) {
    ?>
                    <div class="alert text-center" role="alert" style="background:#fd7e14;color:#fff;">
                        it is available, complete your information and make a reservation
                    </div>
                    <?php
}
?>
                <div class="mb-3">
                    <label class="form-label">name</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label class="form-label">phone number</label>
                    <input type="text" class="form-control" id="phone">
                </div>
                <div class="mb-3">
                    <label class="form-label">National ID</label>
                    <input type="text" class="form-control" id="id">
                </div>
                <div class="mb-3">
                    <label class="form-label">check in</label>
                    <input type="date" id="in" class="form-control" value="<?=(isset($_GET['checkIn'])) ? $_GET['checkIn'] : ''?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">check out</label>
                    <input type="date" id="out" class="form-control" value="<?=(isset($_GET['checkOut'])) ? $_GET['checkOut'] : ''?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">adults</label>
                    <input type="text" id="adults" class="form-control" value="<?=(isset($_GET['adults'])) ? $_GET['adults'] : ''?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">children (1 - 13) years</label>
                    <input type="text" id="children" class="form-control" value="<?=(isset($_GET['children'])) ? $_GET['children'] : ''?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">room type</label>
                    <select id="room_type" class="form-select" aria-label="Default select example">
                    <?php
if (isset($this->loadData['rooms_types'])) {
    ?>
    <option value="">choose type</option>
    <?php
foreach ($this->loadData['rooms_types'] as $row) {
        ?>
                            <option value="<?=$row['name']?>" <?=(isset($_GET['roomType']) && $_GET['roomType'] == $row['name']) ? 'selected' : ''?>><?=$row['name']?></option>
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
                <div class="mb-3">
                    <label class="form-label">number of rooms</label>
                    <input type="text" id="number_of_rooms" class="form-control" value="<?=(isset($_GET['numberOfRooms'])) ? $_GET['numberOfRooms'] : ''?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">notes</label>
                    <textarea id="notes" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" id="submit" class="btn d-block m-auto">Book Now</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
$('#submit').click(function(){
        event.preventDefault();
        var checkIn = $('#in').val();
        var checkOut = $('#out').val();
        var roomType = $('#room_type').val();
        var numberOfRooms = $('#number_of_rooms').val();
        var adults = $('#adults').val();
        var children = $('#children').val();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var id = $('#id').val();
        var notes = $('#notes').val();
        $.ajax({
            url: "/CheckAvailability/bookNow",
            method: 'POST',
            data: {
                checkIn: checkIn,
                checkOut: checkOut,
                roomType: roomType,
                numberOfRooms: numberOfRooms,
                adults: adults,
                children:children,
                name: name,
                phone: phone,
                id: id,
                notes: notes,
            },
            success: function (data) {
                alert(data);
            },
        });
    });
</script>
