var body = new Vue({
    el: 'body',
    data: {
        btnName: 'Spin It!',
        giftee: '...',
        btnSpinEnabled: false,
        santa,
    },
    methods: {
        spinName: function () {
            var giftees = $('#giftee').data('value');
            if (this.btnName == 'Stop!') {
                stopSpin(giftees, this);
                savePick();
            }
            if (this.btnName == 'Spin It!') {
                startSpin(giftees, this);
            }
        },
        enableSpin: function () {
            if (this.santa != '---' && this.btnName != "Done!") {
                this.btnSpinEnabled = true;
            }
        }
    }
});

function startSpin(giftees, vue) {
    delete giftees[$('#santa option:selected').text()];
    vue.giftee = Object.keys(giftees).join();
    vue.btnName = 'Stop!';

    setTimeout(function () {
            $(".rotate").textrotator({
                animation: "flipCube",
                speed: 300
            })
        }
        , 100
    );
}

function stopSpin(giftees, vue) {
    var names = Object.keys(giftees);
    var chosenName = names[Math.floor(Math.random() * names.length)];
    vue.btnName = 'Done!';
    vue.btnSpinEnabled = false;
    console.log(giftees[chosenName]);
    $('#giftee').text(chosenName);
}

function savePick() {
    var giftees = $('#giftee').data('value');
    $.post("/kris-kringle",
        {
            _token: $('#crf').val(),
            id: $('#santa').val(),
            picked_id: giftees[$('#giftee').text()],
        },
        function (data, status) {
            alert("Saved Thank You!");
        });
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});