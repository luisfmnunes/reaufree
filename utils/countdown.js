var run = false;

function countdown(min, seg) {

    function clock() {

        if (run) {
            return;
        }

        if ((min > 0) || (seg > 0)) {
            if (seg == 0) {
                seg = 59;
                min = min - 1
            } else {
                seg = seg - 1;
            }
            if (min.toString().length == 1) {
                min = "0" + min;
            }
            if (seg.toString().length == 1) {
                seg = "0" + seg;
            }
            document.getElementById('timer').innerHTML = min + ":" + seg;
            setTimeout(() => {
                clock();
            }, 1000);

            document.getElementById('receber').hidden = true;
            document.getElementById('timer-div').style = "display: flex !important;";

        }

        if (min == 0 && seg == 0) {
            // console.log("Entrou no ELse:\n" + min + ":" + seg);
            document.getElementById('receber').hidden = false;
            document.getElementById('timer-div').style = "display: none !important;";
        }

        if (min == 0 && seg == 5) {
            var sound = document.getElementById('timer_zero').play();
            sound.volume = 0.35;
        }
    }
    setTimeout(() => {
        clock();
    }, 1000);
}
