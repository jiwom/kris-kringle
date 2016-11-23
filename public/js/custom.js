var body = new Vue({
    el: 'body',
    data: {
        btnName: 'Spin It!',
        giftee: '...',
    },
    methods: {
        spinName: function () {
            var giftee = $('#giftee').data('names');
            if (this.btnName == 'Stop!') {
                this.btnName = 'Done!';
                stopSpin(giftee);
                saveData();
            }
            if (this.btnName == 'Spin It!') {
                this.giftee = giftee;
                this.btnName = 'Stop!';
                startSpin();
            }
        }
    }
});

function startSpin() {
    setTimeout(function () {
            $(".rotate").textrotator({
                animation: "flipCube",
                speed: 50
            })
        }
        , 100
    );
}

function stopSpin(giftee) {
    $('#btn-spin').addClass('disabled');
    var names = giftee.split(',');
    var chosenName = names[Math.floor(Math.random() * names.length)];
    $('#giftee').text(chosenName);
}

function saveData() {
    $.post("/",
        {
            name: "Donald Duck",
            city: "Duckburg"
        },
        function (data, status) {
            alert("Data: " + data + "\nStatus: " + status);
        });
}