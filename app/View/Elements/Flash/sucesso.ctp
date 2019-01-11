

<script type="text/javascript">
    

    // $(window).scroll(function(){

    $(function() {

        setTimeout(function() {
            $.bootstrapGrowl("<b>SUCESSO!</b><br><h5><?php echo $message; ?></h5>", {
                type: 'success text-right',
                align: 'right',
                width: 'auto',
            offset: {from: 'bottom', amount: 20}, // 'top', or 'bottom'
            stackup_spacing: 10,
            allow_dismiss: true,
            delay: 5000,
            showProgressbar: true
        });
        }, 400);

       
    });


    
</script>