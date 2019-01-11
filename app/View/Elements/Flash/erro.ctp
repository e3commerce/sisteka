

<script type="text/javascript">
    
	$(function() {

        setTimeout(function() {
            $.bootstrapGrowl("<b>PROBLEMA!</b><br><h5><?php echo $message; ?></h5>", {
                type: 'danger text-right',
                align: 'right',
                width: 'auto',
            offset: {from: 'bottom', amount: 20}, // 'top', or 'bottom'
            stackup_spacing: 10,
            allow_dismiss: true,
            delay: 20000,
        });
        }, 400);







    });

       


	
</script>

