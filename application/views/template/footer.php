<script type="text/javascript">
	$(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('DD MM YYYY') + ' '
                            + momentNow.format('dddd').substring(0,3) + ' ' + momentNow.format('A hh:mm:ss'));
        // $('#time-part').html();
    }, 100);
    
    $('#stop-interval').on('click', function() {
        clearInterval(interval);
    });
});

</script>
</body>
</html>
