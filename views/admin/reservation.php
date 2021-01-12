<div class="card w-75 m-auto">
    <div class="card-header text-center">
    <strong>book now</strong>
    </div>
    <?php if (isset($this->loadData['error'])): ?>
        <div class="alert alert-danger msg"><?=$this->loadData['error']?></div>
        <?php endif;?>
        <?php if (isset($this->loadData['success'])): ?>
        <div class="alert alert-success msg"><?=$this->loadData['success']?></div>
        <?php endif;?>
    <div class="card-body card-block">
        <form action="">
            <div class="form-group"><label class=" form-control-label">name</label><input id="name" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">phone</label><input id="phone" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">national id</label><input id="id" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">check in</label><input id="in" type="date" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">check out</label><input id="out" type="date" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">room type</label>
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
            <div class="form-group"><label class=" form-control-label">adults</label><input id="adults" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">children</label><input id="children" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">number of rooms</label><input id="number_of_rooms" type="text" class="form-control"></div>
            <div class="form-group">
                            <div><label class=" form-control-label">paid</label></div>
                            <div>
                              <div class="form-check">
                                <div class="radio">
                                  <label for="radio1" class="form-check-label ">
                                    <input type="radio" id="paid" value="yes" name="paid" class="form-check-input">yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label for="radio2" class="form-check-label ">
                                    <input type="radio" id="paid" value="no" name="paid" class="form-check-input">no
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
            <div class="form-group"><label class=" form-control-label">notes</label>
            <textarea id="notes" class="form-control" rows="4"></textarea></div>
            <div class="mb-3">
                <button id="a7a" class="btn btn-primary btn-md d-block w-50 m-auto">RESERVE</button>
            </div>
            <div class="alert alert-success" id="msg" style="display:none">

            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#room_type').multiselect({
            buttonWidth: '100%'
        });
    });

    $('#a7a').click(function(){
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
        var paid = $('input[name="paid"]:checked').val();

        if(roomType == null){
            return alert('Empty Field');
        }
        var arr = [[roomType[0], numberOfRooms]];

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
            url: "/CheckAvailability/bookNow",
            method: 'POST',
            data: {
                checkIn: checkIn,
                checkOut: checkOut,
                numberOfRooms: numberOfRooms,
                adults: adults,
                children:children,
                name: name,
                phone: phone,
                id: id,
                notes: notes,
                arr:arr,
                paid:paid
            },
            success: function (data) {
                if(data.includes('finished')){
                    $('#in').val("");
                    $('#out').val("");
                    $('#room_type').val("");
                    $('#number_of_rooms').val("");
                    $('#adults').val("");
                    $('#children').val("");
                    $('#name').val("");
                    $('#phone').val("");
                    $('#id').val("");
                    $('#notes').val("");
                    $('#paid').val("");

                    var response = data.split('/');
                    $('#msg').html("The reservation was successful, the cost is $ "+response[0]);
                    $('#msg').css('display', 'block');
                }else{
                    alert(data);
                }
            },
        });
    });
</script>
