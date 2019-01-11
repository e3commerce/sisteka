<div class="main-content">


  <div class="row">

    <div class="col-md-12">
      <div class="row">
        
         <div class="col-md-12"><h2 style="border-bottom: 1px dashed #ccc;">Página Inicial</h2></div>

         
      </div>

<script>
  app.ready(function(){


    



        // Scoll to the end of chat content
        $('#chat-content').scrollToEnd();




        // Earning chart
        //
        var chartjs2 = new Chart($("#chart-js-2"), {
          type: 'line',
          data: {
            labels: [<?php echo $dados['grafico']['Nome'] ?>],
            datasets: [
            {
              label: "Revenue",
              backgroundColor: "rgba(51,202,185,0.5)",
              borderWidth: 0,
              borderColor: "rgba(0,0,0,0)",
              data: [<?php echo $dados['grafico']['Valor'] ?>]
            }
            ]
          },
          options: {
            legend: {
              display: false
            },
          }
        });


      });
    </script>