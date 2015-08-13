<!DOCTYPE html>
<html class="lockscreen">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>管理页面_<?=Config::get( 'laravel-cms::site.name' )?></title>
    <meta name="description" content="{{ $description or '' }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="renderer" content="webkit|ie-stand|ie-comp">
    @if( isset( $_controller ) && $_controller instanceof \Xjtuwangke\L5Controller\L5ViewController )
        {!! $_controller->getAssets()->renderAll() !!}
    @endif
</head>
<body>
<!-- Automatic element centering using js -->
<div class="center" id="lockscreed-shakable">
    <div class="headline text-center" id="time">
        <!-- Time auto generated by js -->
    </div><!-- /.headline -->
    <!-- User name -->
    <div class="lockscreen-name"><?=$user->username?></div>
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="<?=$user->avatar?>" alt="user image"/>
        </div>
        <!-- /.lockscreen-image -->
        <!-- lockscreen credentials (contains the form) -->
        <div class="lockscreen-credentials">
            <form method="POST">
                <?=csrf_field()?>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="password" />
                    <div class="input-group-btn">
                        <button class="btn btn-flat"><i class="fa fa-arrow-right text-muted"></i></button>
                    </div>
                </div>
            </form>
        </div><!-- /.lockscreen credentials -->
    </div><!-- /.lockscreen-item -->
    <div class="lockscreen-link">
        <a href="{{ url('admin/logout') }}">登出并以其它身份登陆</a>
    </div>
</div><!-- /.center -->
<!-- page script -->
<script type="text/javascript">
    $(function() {
        startTime();
        $(".center").center();
        $(window).resize(function() {
            $(".center").center();
        });
    });

    /*  */
    function startTime()
    {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();

        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);

        //Check for PM and AM
        var day_or_night = (h > 11) ? "PM" : "AM";

        //Convert to 12 hours system
        if (h > 12)
            h -= 12;

        //Add time to the headline and update every 500 milliseconds
        $('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
        setTimeout(function() {
            startTime()
        }, 500);
    }

    function checkTime(i)
    {
        if (i < 10)
        {
            i = "0" + i;
        }
        return i;
    }

    /* CENTER ELEMENTS IN THE SCREEN */
    jQuery.fn.center = function() {
        this.css("position", "absolute");
        this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
            $(window).scrollTop()) - 30 + "px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
            $(window).scrollLeft()) + "px");
        return this;
    }
    <?php if( $error ):?>
        $(function(){
            $('#lockscreed-shakable').effect('shake', { times:3 }, 100);
        });
    <?php endif;?>
</script>
</body>
</html>