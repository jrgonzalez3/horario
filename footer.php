<div class="navbar navbar-inverse navbar-fixed-bottom hidden-xs">
    <div class="container" style="color: #ecf0f1; padding: 0px!important;">
        <span class="text pull-left">&copy 2015 -
            <?php echo date('Y'); ?> | <?php echo date('d-m-Y'); ?> | <span id="reloj"></span>
        </span>
        <span class="text pull-right">
            PersonalController - <b> Version </b> 1.0 | <a href="https://www.jringenieriayservicios.com" target="_blank">JR Ingeniería y Servicios </a>
        </span>
    </div>
</div>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/bootstrap-datepicker.js"></script>
<script src="./assets/js/jquery.dataTables.min.js"></script>
<script src="./assets/scripts/klorofil-common.js"></script>
<script src="./assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript">
function startTime() {
    today = new Date();
    h = today.getHours();
    m = today.getMinutes();
    s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('reloj').innerHTML = h + ":" + m + ":" + s;
    t = setTimeout('startTime()', 500);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
window.onload = function() {
    startTime();
}
</script>

