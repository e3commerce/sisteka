

<script type="text/javascript">
    
	$(function() {

        setTimeout(function() {
            $.bootstrapGrowl("<b>INFORMAÇÃO!</b><br><h5><?php echo $message; ?></h5>", {
                type: 'success text-right',
                align: 'right',
                width: 'auto',
            offset: {from: 'bottom', amount: 20}, // 'top', or 'bottom'
            stackup_spacing: 10,
            allow_dismiss: true,
            delay: 5000,
        });
        }, 400);

    });


	
</script>