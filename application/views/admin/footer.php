<div class="overlay" onclick="$('.modal, .overlay').hide();"></div>
<audio id="audio" src="<?php echo href("sound/notification.mp3");?>"></audio>
</audio>
<div class="msgbox"></div>
<script type="text/javascript">
var audio = document.getElementById("audio");
function playAudio() {
    audio.play();
}

function pauseAudio() {
    audio.pause();
}

if ( $(".info").length > 0 ) {
    setTimeout(function(){
        $(".info").slideUp(1500);
    }, 500)
}
function deleteBox(table) {
    // If our global container empty then we should stop.
    if( !box.length ) return;
    var confirmDelete = confirm("<?php echo $lang->confirm_delete;?>");
    if( confirmDelete ) {
        admin.delete(table, box);
    }
}

var timestamp = +new Date();
var lastOrderId = <?php echo ( !empty($_SESSION["last_order_id"]) ) ? $_SESSION["last_order_id"] : 0;?>;
var counter = <?php echo ( !empty($_SESSION["totalPendingOrders"]) ) ? $_SESSION["totalPendingOrders"] : 0;?>;
setInterval(function(){

    $.ajax({
        url: base_url+'/ajax/getOrders',
        type: "GET",
        success: function(data) {
            var data = JSON.parse(data);
            if ( data ) {

                if ( data.data.id && lastOrderId != data.data.id) {
                    counter++;
                    document.title = "<?php echo $lang->orders;?>"+" ("+counter+") ";
                    lastOrderId = data.data.id;
                    $("#notification").show().html(counter);
                    playAudio();
                }

            }
        }
    })

}, 10000);

</script>
<footer></footer>
</body>
</html>
