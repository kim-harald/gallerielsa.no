<div class="row" data-id="0">
    <div>
    	<input type="text" class="exhibition-name" placeholder="utstillingstitel"></input>
    </div>
    <div class="dateGroup">
    	<label for="exhibition-startDate">startdato</label>
    	<input name="exhibition-startDate" type="date" class="exhibition-startDate" placeholder=""></input>
    </div>
    <div class="dateGroup">
    	<label for="exhibition-endDate">sluttdato</label>
    	<input name="exhibition-endDate" type="date" class="exhibition-endDate" placeholder=""></input>
    </div>
    <div>
        <a href="#main" class="btn save nav" data-id="0"><span class="glyphicon glyphicon-floppy-save"></span></a>
        <a href="#main" class="btn nav"><span class="glyphicon glyphicon-menu-up"></span></a>
    </div>
</div>
<div class="slideShow bss-slides">
    <figure>
        <img src="../pictures/2015-03-15.jpg">
        <figcaption>Portrait of Van Gogh - Kassya Dadswell<figcaption>';
    </figure>
    <figure>
        <img src="../pictures/2015-10-15.jpg">
        <figcaption>Group - Kassya Dadswell<figcaption>';
    </figure>
    <figure>
        <img src="../pictures/CAM00215.jpg">
        <figcaption>Group Two - Kassya Dadswell<figcaption>';
    </figure>
</div>
<script>
    var isEdit = true; // set by php.
    $(function() {

        var opts = {
            auto: {
                speed: 3500,
                pauseOnHover: true
            },
            fullScreen: false,
            swipe: true
        };
        makeBSS('.slideShow', opts);
    });
    
</script>